import os
import re
from pathlib import Path
import shutil

# Source and destination directories
SOURCE_DIR = Path(r"G:\My Drive\Projects\Portfolio\cloudways_site")
DEST_DIR = Path(r"G:\My Drive\Projects\Portfolio")

def get_projects():
    """Simulate the PHP get_projects() function"""
    projects_dir = SOURCE_DIR / "projects"
    projects = []

    for php_file in projects_dir.glob("*.php"):
        if php_file.name == "index.php":
            continue

        # Read the file to extract metadata
        content = php_file.read_text(encoding='utf-8')

        # Extract title
        title_match = re.search(r"'title'\s*=>\s*'([^']*)'", content)
        title = title_match.group(1) if title_match else php_file.stem.replace('-', ' ').title()

        # Extract date
        date_match = re.search(r"'date'\s*=>\s*'([^']*)'", content)
        date = date_match.group(1) if date_match else ""

        # Extract keywords
        keywords_match = re.search(r"'keywords'\s*=>\s*\[(.*?)\]", content, re.DOTALL)
        keywords = []
        if keywords_match:
            kw_content = keywords_match.group(1)
            keywords = [k.strip().strip("'\"") for k in kw_content.split(',') if k.strip()]

        # Extract excerpt from first <p class="lead">
        excerpt_match = re.search(r'<p class=["\']lead["\']>(.*?)</p>', content, re.DOTALL)
        excerpt = ""
        if excerpt_match:
            excerpt_text = re.sub(r'<[^>]+>', '', excerpt_match.group(1))
            excerpt_text = excerpt_text.strip()
            if len(excerpt_text) > 160:
                excerpt = excerpt_text[:160] + "..."
            else:
                excerpt = excerpt_text

        # Find thumbnail image
        thumb = "/assets/images/placeholder.jpg"
        # Extract actual folder path from PHP content
        folder_match = re.search(r"'(/assets/images/[^']+)'", content)
        if folder_match:
            folder_path = folder_match.group(1).lstrip('/').rstrip('/')
            img_folder = DEST_DIR / folder_path
            if img_folder.exists():
                for ext in ['jpg', 'jpeg', 'png', 'gif', 'webp', 'JPG', 'JPEG', 'PNG', 'GIF', 'WEBP']:
                    images = list(img_folder.glob(f"*.{ext}"))
                    if images:
                        images_sorted = sorted([img for img in images if img.name.lower() != 'desktop.ini'])
                        if images_sorted:
                            thumb = f"/{folder_path}/{images_sorted[0].name}"
                            break

        projects.append({
            'title': title,
            'date': date,
            'keywords': keywords,
            'excerpt': excerpt,
            'thumb': thumb,
            'link': f"/projects/{php_file.stem}.html"
        })

    # Sort by date descending
    projects.sort(key=lambda x: x['date'], reverse=True)
    return projects

def render_header():
    """Render the header HTML"""
    return """<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Josh Ingram</title>
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
 <header class="site-header">
  <div class="container header-inner">
    <div class="brand"><a href="/index.html">Josh Ingram</a></div>
    <div class="menu-toggle" onclick="toggleMenu()">☰ Menu</div>
    <nav class="main-nav">
      <a href="/index.html">Home</a>
      <a href="/projects.html">Projects</a>
      <a href="/about.html">About</a>
      <a href="/contact.html">Contact</a>
    </nav>
  </div>
</header>

<script>
function toggleMenu(){
  const nav=document.querySelector('.main-nav');
  nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
}
</script>

  <main class="site-content container">
"""

def render_footer():
    """Render the footer HTML"""
    return """
  </main>
  <footer class="site-footer">
    <div class="container">
      &copy; 2025 Josh Ingram &mdash; <a href="mailto:joshua.w.ingram@gmail.com">joshua.w.ingram@gmail.com</a>
    </div>
  </footer>
</body>
</html>
"""

def convert_php_content(content):
    """Convert PHP-specific content to static HTML"""
    # Remove PHP tags and meta array
    content = re.sub(r'<\?php.*?\$meta.*?\];.*?\?>', '', content, flags=re.DOTALL)

    # Remove includes
    content = re.sub(r'<\?php\s+include[^;]+;.*?\?>', '', content, flags=re.DOTALL)

    # Replace PHP echo calls in meta display
    content = re.sub(r'<\?php\s+echo\s+htmlspecialchars\(\$meta\[\'title\'\]\);\s*\?>', '[TITLE]', content)
    content = re.sub(r'<\?php\s+echo\s+htmlspecialchars\(\$meta\[\'date\'\]\);\s*\?>', '[DATE]', content)

    # Remove carousel PHP logic but keep structure
    content = re.sub(r'<\?php.*?endforeach;.*?\?>', '<!-- Images loaded -->', content, flags=re.DOTALL)
    content = re.sub(r'<\?php.*?\?>', '', content, flags=re.DOTALL)

    return content

def render_project_images(project_name, php_content):
    """Generate HTML for project images in carousel"""
    # Extract the actual image folder path from PHP content
    folder_match = re.search(r"'(/assets/images/[^']+)'", php_content)
    if not folder_match:
        return ""

    folder_path = folder_match.group(1).lstrip('/').rstrip('/')
    img_folder = DEST_DIR / folder_path
    html = ""

    if img_folder.exists():
        images = []
        for ext in ['jpg', 'jpeg', 'png', 'gif', 'webp', 'JPG', 'JPEG', 'PNG', 'GIF', 'WEBP']:
            images.extend(list(img_folder.glob(f"*.{ext}")))

        # Remove duplicates (Windows glob is case-insensitive) and sort
        images = sorted(list(set([img for img in images if img.name.lower() != 'desktop.ini'])))

        for i, img in enumerate(images):
            # First image loads immediately, rest use lazy loading
            if i == 0:
                html += f"      <img src='/{folder_path}/{img.name}' alt='Project image'>\n"
            else:
                html += f"      <img src='/{folder_path}/{img.name}' loading='lazy' alt='Project image'>\n"

    return html

def convert_project_page(php_file):
    """Convert a project PHP file to HTML"""
    content = php_file.read_text(encoding='utf-8')

    # Extract metadata
    title_match = re.search(r"'title'\s*=>\s*'([^']*)'", content)
    title = title_match.group(1) if title_match else php_file.stem.replace('-', ' ').title()

    date_match = re.search(r"'date'\s*=>\s*'([^']*)'", content)
    date = date_match.group(1) if date_match else ""

    # Convert PHP content
    static_content = convert_php_content(content)
    static_content = static_content.replace('[TITLE]', title)
    static_content = static_content.replace('[DATE]', date)

    # Replace project links
    static_content = re.sub(r'/projects\.php', '/projects.html', static_content)

    # Replace carousel images
    carousel_match = re.search(r'<div class="slides">(.*?)</div>', static_content, re.DOTALL)
    if carousel_match:
        images_html = render_project_images(php_file.stem, content)
        static_content = static_content.replace(carousel_match.group(0),
                                                f'<div class="slides">\n{images_html}    </div>')

    # Build complete HTML
    html = render_header() + static_content + render_footer()

    return html

def convert_projects_page():
    """Convert the projects listing page"""
    projects = get_projects()

    html = render_header()
    html += """<section class="hero">
  <h1>Projects</h1>
  <div class="sort-controls">
    Sort by: Date | Title
  </div>
</section>
<section class="project-list">
"""

    for proj in projects:
        html += f"""  <div class="proj-card">
    <div class="proj-thumb">
      <img src="{proj['thumb']}" alt="{proj['title']}">
    </div>
    <div class="proj-info">
      <h3><a href="{proj['link']}">{proj['title']}</a></h3>
      <p class="proj-date">{proj['date']}</p>
      <p class="proj-excerpt">{proj['excerpt']}</p>
"""
        if proj['keywords']:
            html += f"      <p class=\"proj-tags\">Keywords: {', '.join(proj['keywords'])}</p>\n"
        html += "    </div>\n  </div>\n"

    html += "</section>\n"
    html += render_footer()

    return html

def convert_simple_page(php_file):
    """Convert a simple PHP page (index, about, contact)"""
    content = php_file.read_text(encoding='utf-8')

    # Remove PHP includes
    content = re.sub(r'<\?php.*?\?>', '', content, flags=re.DOTALL)

    # Replace links
    content = re.sub(r'\.php', '.html', content)

    html = render_header() + content + render_footer()
    return html

def main():
    print("Converting PHP site to static HTML...")

    # Create projects directory
    dest_projects = DEST_DIR / "projects"
    dest_projects.mkdir(exist_ok=True)

    # Copy assets
    print("Copying assets...")
    if (SOURCE_DIR / "assets").exists():
        dest_assets = DEST_DIR / "assets"
        if dest_assets.exists():
            shutil.rmtree(dest_assets)
        shutil.copytree(SOURCE_DIR / "assets", dest_assets)

    # Convert index page
    print("Converting index.html...")
    index_html = convert_simple_page(SOURCE_DIR / "index.php")
    (DEST_DIR / "index.html").write_text(index_html, encoding='utf-8')

    # Convert about page
    print("Converting about.html...")
    about_html = convert_simple_page(SOURCE_DIR / "about.php")
    (DEST_DIR / "about.html").write_text(about_html, encoding='utf-8')

    # Convert contact page
    print("Converting contact.html...")
    contact_html = convert_simple_page(SOURCE_DIR / "contact.php")
    (DEST_DIR / "contact.html").write_text(contact_html, encoding='utf-8')

    # Convert projects listing page
    print("Converting projects.html...")
    projects_html = convert_projects_page()
    (DEST_DIR / "projects.html").write_text(projects_html, encoding='utf-8')

    # Convert each project page
    print("Converting project pages...")
    projects_dir = SOURCE_DIR / "projects"
    for php_file in projects_dir.glob("*.php"):
        if php_file.name == "index.php":
            continue

        print(f"  - {php_file.stem}.html")
        html = convert_project_page(php_file)
        (dest_projects / f"{php_file.stem}.html").write_text(html, encoding='utf-8')

    print("\n✅ Conversion complete!")
    print(f"Static site created in: {DEST_DIR}")
    print("\nFiles created:")
    print("  - index.html")
    print("  - about.html")
    print("  - contact.html")
    print("  - projects.html")
    print(f"  - projects/*.html ({len(list(dest_projects.glob('*.html')))} files)")

if __name__ == "__main__":
    main()
