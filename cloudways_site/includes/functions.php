<?php
function pretty_title_from_filename($filename) {
    $name = basename($filename, '.php');
    $name = str_replace('_', ' ', $name);
    $name = str_replace('-', ' ', $name);
    $name = ucwords($name);
    return $name;
}

function extract_meta($file) {
    $meta = [
        'title' => pretty_title_from_filename($file),
        'date' => '',
        'keywords' => [],
        'excerpt' => '',
        'thumb' => '/assets/images/placeholder1.jpg'
    ];
    $content = file_get_contents($file);
    if (preg_match('/\$meta\s*=\s*\[(.*?)\];/s', $content, $match)) {
        $jsonish = $match[1];
        if (preg_match('/\'title\'\s*=>\s*\'(.*?)\'/', $jsonish, $t)) $meta['title'] = $t[1];
        if (preg_match('/\'date\'\s*=>\s*\'(.*?)\'/', $jsonish, $d)) $meta['date'] = $d[1];
        if (preg_match('/\'keywords\'\s*=>\s*\[(.*?)\]/s', $jsonish, $k)) {
            $kw = array_map('trim', explode(',', str_replace("'", '', $k[1])));
            $meta['keywords'] = array_filter($kw);
        }
    }
	// find first image (if no inline <img>, look in matching assets folder)
	if (preg_match('/<img[^>]+src=\"([^\"]+)\"/i', $content, $im)) {
    $meta['thumb'] = $im[1];
} else {
    $folderName = strtolower(basename($file, '.php'));
    $imgFolder = __DIR__ . '/../assets/images/' . $folderName . '/';
    if (is_dir($imgFolder)) {
        $images = glob($imgFolder . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        if ($images) {
            $meta['thumb'] = '/assets/images/' . $folderName . '/' . basename($images[0]);
        }
    }
}

// find first readable paragraph (skip PHP tags)
if (preg_match_all('/<p[^>]*>(.*?)<\/p>/is', $content, $matches) && !empty($matches[1])) {
    $text = strip_tags(trim($matches[1][0]));
    $meta['excerpt'] = substr($text, 0, 160) . (strlen($text) > 160 ? '...' : '');
}

    return $meta;
}

function get_projects($dir = __DIR__ . '/../projects') {
    $files = glob($dir . '/*.php');
    $projects = [];
    foreach ($files as $file) {
        $base = basename($file);
        if ($base === 'index.php') continue;
        $meta = extract_meta($file);
        $meta['link'] = '/projects/' . $base;
        $projects[] = $meta;
    }
    // sorting
    $sort = $_GET['sort'] ?? 'date';
    if ($sort === 'title') {
        usort($projects, fn($a,$b)=>strcasecmp($a['title'],$b['title']));
    } else {
        usort($projects, fn($a,$b)=>strcmp($b['date'],$a['date']));
    }
    return $projects;
}
?>