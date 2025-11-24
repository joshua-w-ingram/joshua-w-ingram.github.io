import os
from pathlib import Path
from PIL import Image

# Directories to optimize
BASE_DIR = Path(r"G:\My Drive\Projects\Portfolio\assets\images")
FOLDERS_TO_OPTIMIZE = ['project-landscape-1', 'project-landscape-2', 'project-camp-bullis']

# Target max width for images (height will scale proportionally)
MAX_WIDTH = 1200
MAX_HEIGHT = 900

# JPEG quality (0-100, 75 provides good quality with much smaller file size)
JPEG_QUALITY = 75

def optimize_image(image_path):
    """Resize and compress an image"""
    try:
        with Image.open(image_path) as img:
            # Convert RGBA to RGB if necessary
            if img.mode == 'RGBA':
                img = img.convert('RGB')

            # Get original size
            original_size = os.path.getsize(image_path)
            width, height = img.size

            # Calculate new size maintaining aspect ratio
            if width > MAX_WIDTH or height > MAX_HEIGHT:
                ratio = min(MAX_WIDTH / width, MAX_HEIGHT / height)
                new_width = int(width * ratio)
                new_height = int(height * ratio)

                # Resize using high-quality Lanczos filter
                img = img.resize((new_width, new_height), Image.Resampling.LANCZOS)
                print(f"  Resized from {width}x{height} to {new_width}x{new_height}")

            # Save with optimization
            img.save(image_path, 'JPEG', quality=JPEG_QUALITY, optimize=True)

            new_size = os.path.getsize(image_path)
            reduction = ((original_size - new_size) / original_size) * 100

            print(f"  Size: {original_size:,} -> {new_size:,} bytes ({reduction:.1f}% reduction)")
            return True

    except Exception as e:
        print(f"  Error: {e}")
        return False

def main():
    print("Optimizing landscape project images...\n")

    total_original = 0
    total_new = 0
    processed = 0

    for folder_name in FOLDERS_TO_OPTIMIZE:
        folder_path = BASE_DIR / folder_name

        if not folder_path.exists():
            print(f"Skipping {folder_name} (not found)")
            continue

        print(f"Processing {folder_name}/")

        # Get all image files
        extensions = ['*.jpg', '*.jpeg', '*.png', '*.JPG', '*.JPEG', '*.PNG']
        images = []
        for ext in extensions:
            images.extend(list(folder_path.glob(ext)))

        # Filter out desktop.ini
        images = [img for img in images if img.name.lower() != 'desktop.ini']

        for img_path in images:
            print(f"  {img_path.name}")
            original_size = os.path.getsize(img_path)

            if optimize_image(img_path):
                new_size = os.path.getsize(img_path)
                total_original += original_size
                total_new += new_size
                processed += 1

        print()

    if processed > 0:
        total_reduction = ((total_original - total_new) / total_original) * 100
        print(f"Optimization complete!")
        print(f"Processed: {processed} images")
        print(f"Total size: {total_original:,} -> {total_new:,} bytes")
        print(f"Total reduction: {total_reduction:.1f}%")
        print(f"Space saved: {(total_original - total_new):,} bytes")
    else:
        print("No images processed")

if __name__ == "__main__":
    main()
