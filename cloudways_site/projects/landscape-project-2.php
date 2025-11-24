<?php
$meta = [
  'title' => 'Wyckoff Ranch — Tiered Lake System & Landscape Terracing',
  'date' => '2018-06-01',
  'keywords' => ['landscape architecture', 'water features', 'lake design', 'stone masonry', 'terracing', 'riverfront']
];
include __DIR__ . '/../partials/header.php';
?>

<section>
  <h1 class="section-title"><?php echo htmlspecialchars($meta['title']); ?></h1>
  <p class="proj-date"><?php echo htmlspecialchars($meta['date']); ?></p>

  <!-- Carousel -->
  <div class="carousel">
    <div class="slides">
      <?php
        $folder = __DIR__ . '/../assets/images/project-landscape-2/';
        $webpath = '/assets/images/project-landscape-2/';
        if (is_dir($folder)) {
          $images = glob($folder . '*.{jpg,jpeg,png,gif,webp,JPG,JPEG,PNG,GIF,WEBP}', GLOB_BRACE);
          sort($images);
          $first = true;
          foreach ($images as $file) {
            $filename = basename($file);
            if ($filename !== 'desktop.ini') {
              // First image loads immediately, rest use lazy loading
              if ($first) {
                echo "<img src='{$webpath}{$filename}' alt='Project image'>";
                $first = false;
              } else {
                echo "<img src='{$webpath}{$filename}' loading='lazy' alt='Project image'>";
              }
            }
          }
        }
      ?>
    </div>
    <button class="prev">❮</button>
    <button class="next">❯</button>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", function(){
    const carousel = document.querySelector('.carousel');
    if (!carousel) return;
    const slidesContainer = carousel.querySelector('.slides');
    const slides = slidesContainer.querySelectorAll('img');
    if (slides.length === 0) return;
    const prev = carousel.querySelector('.prev');
    const next = carousel.querySelector('.next');
    let index = 0;
    function showSlide(i){
      index = (i + slides.length) % slides.length;
      slidesContainer.style.transform = `translateX(${-index * 100}%)`;
    }
    prev.addEventListener('click', ()=> showSlide(index - 1));
    next.addEventListener('click', ()=> showSlide(index + 1));
    showSlide(0);
  });
  </script>

  <p class="lead">
    The Wyckoff property spans 30 acres along the Guadalupe River, presenting both an opportunity and
    a challenge: how to transform sloped terrain into a series of functional, beautiful spaces that work
    with the natural topography. Working with my father, we designed and built a cascading lake system
    that terraces from the high point of the property down to the river's edge.
  </p>

  <h2 class="section-title">Design Intent</h2>
  <p>
    The client's vision was to prepare the land for eventual home construction while creating a
    landscape that would be striking and functional in its own right. Rather than fight the property's
    elevation changes, we embraced them—designing a series of tiered lakes that step down the slope,
    each level held by carefully constructed stone terracing.
  </p>

  <p>
    The approach centered on reading the land: identifying natural drainage patterns, understanding
    where water wanted to flow, and building structures that enhanced rather than obstructed these
    tendencies. The result is a system that feels inevitable—as if the lakes and terraces had always
    been part of the landscape.
  </p>

  <h2 class="section-title">Construction Process</h2>
  <p>
    We coordinated with specialized stone masons to build the extensive rockwork that defines each
    terrace. Every stone wall serves both structural and aesthetic purposes: retaining earth, managing
    water flow, and framing views across the property. The placement of each lake was determined by
    careful site analysis—considering sun exposure, views, and how water would naturally move through
    the system.
  </p>

  <p>
    Existing trees became focal points rather than obstacles. We built around significant specimens,
    integrating them into the terraced design and using stone walls to create level planting areas at
    their bases. This preserved the property's mature tree canopy while opening up usable space
    throughout the site.
  </p>

  <h2 class="section-title">Water Management</h2>
  <p>
    The tiered lake system operates as a connected whole. Water moves from the upper property down
    through each level, with overflow from one lake feeding the next below. This creates visual
    continuity and manages stormwater naturally—the lakes act as retention features that slow and
    filter runoff before it reaches the Guadalupe River.
  </p>

  <h2 class="section-title">Approach & Methodology</h2>
  <p>
    This project was built through direct engagement with the land—no formal drawings, just continuous
    on-site problem solving and design refinement. Working with my father, we approached each phase
    with a combination of structural knowledge and intuitive understanding of how landscapes function.
    Decisions were made by walking the site, observing water flow during rain events, and adjusting
    the design as construction revealed new opportunities or constraints.
  </p>

  <p>
    This hands-on methodology demands a different kind of design thinking: the ability to visualize
    finished spaces from raw terrain, to understand structural requirements without relying on
    engineered drawings, and to coordinate multiple trades (earthwork, masonry, planting) into a
    coherent sequence. It's a process that requires technical knowledge, spatial reasoning, and
    confidence in making irreversible decisions in real time.
  </p>

  <h2 class="section-title">Outcome</h2>
  <p>
    The completed landscape transformed a steep, difficult site into a series of distinct outdoor
    spaces—each terrace offering different views, different relationships to water, and different
    possibilities for future use. Whether the planned house was ever built, the land itself now
    functions as a cohesive designed environment.
  </p>

  <p>
    These photos represent the only visual documentation of the project, captured during and
    immediately after construction. They show a landscape in transition—stone walls freshly built,
    plantings not yet mature, earth still settling. The completed project demonstrates how rigorous
    site work and careful construction can create landscapes that feel both intentional and organic.
  </p>

  <a class="btn" href="/projects.php">Back to all projects</a>
</section>

<?php include __DIR__ . '/../partials/footer.php'; ?>
