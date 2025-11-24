<?php
$meta = [
  'title' => 'Boller Ranch — Three-Tier Lake System with Integrated Water Features',
  'date' => '2019-08-01',
  'keywords' => ['landscape architecture', 'lake design', 'water circulation', 'stone masonry', 'dam construction', 'ranch landscape']
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
        $folder = __DIR__ . '/../assets/images/project-landscape-1/';
        $webpath = '/assets/images/project-landscape-1/';
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
    Near Comfort, Texas, on a private ranch, my father and I designed and built a three-tier lake system
    from the ground up. The project balances functional water management with aesthetic ambition:
    an upper catch basin that handles fluctuating water levels, a mid-level reservoir for storage,
    and a lower showcase lake—complete with island, mature trees, and stone edges—that serves as
    the visual centerpiece of the property.
  </p>

  <h2 class="section-title">System Design</h2>
  <p>
    The three lakes operate as an integrated water management system, each tier serving a distinct purpose:
  </p>

  <p>
    <strong>Upper Lake (Catch Basin):</strong> Collects drainage from across the property. Water levels
    fluctuate seasonally—even going dry during drought—but the lake is designed to look intentional at
    any water level. Stone edges and grading ensure that exposed earth reads as part of the design, not
    as a deficiency.
  </p>

  <p>
    <strong>Middle Lake (Reservoir):</strong> Maintains stable water storage for the system. While levels
    can vary, this lake stays full most of the time, acting as a buffer between the variable upper basin
    and the consistent lower lake. Its primary function is hydraulic rather than aesthetic, though it
    integrates seamlessly into the landscape.
  </p>

  <p>
    <strong>Lower Lake (Showcase):</strong> The designed focal point. A natural-looking island anchors
    the composition, surrounded by carefully placed trees and a fully rocked perimeter. This lake was
    built to be beautiful year-round, regardless of weather conditions. The adjacent barn sits into the
    side of the dam, creating a functional connection between the agricultural and recreational aspects
    of the property.
  </p>

  <h2 class="section-title">Water Circulation & Features</h2>
  <p>
    Between tiers, we built stone spillways embedded with plumbing infrastructure. When water levels
    are high, overflow cascades naturally from one lake to the next. During drier periods, pumps
    circulate water through the same paths, creating the appearance of flowing waterfalls even when
    the upper lakes aren't full enough to spill naturally.
  </p>

  <p>
    This dual system—passive overflow and active circulation—ensures that the lower lake always benefits
    from moving water, which helps with aeration, prevents stagnation, and maintains the visual
    impression of a fed lake rather than an isolated pond.
  </p>

  <h2 class="section-title">Construction Process</h2>
  <p>
    Every aspect of this project was built by my father and me, starting from raw land. Earthwork
    defined the lake basins and established proper grades for water flow. We handled dam construction,
    ensuring structural integrity while creating natural-looking profiles. Stone masonry around the
    lower lake's perimeter required both technical precision (to prevent erosion and anchor the edges)
    and aesthetic judgment (to make the rockwork look uncontrived).
  </p>

  <p>
    The island in the lower lake presented a unique challenge: it needed to support mature trees
    while maintaining structural stability in standing water. We built up the island base, established
    proper drainage, and integrated it with the lake's circulation system. Planting and stone placement
    around the island were designed to look as if they'd evolved naturally over time.
  </p>

  <h2 class="section-title">Design Approach</h2>
  <p>
    Like the Wyckoff project, this work proceeded without formal drawings—every decision was made
    on-site, informed by direct observation and accumulated experience. This approach requires
    a specific skill set: the ability to read topography, predict how water will behave under
    different conditions, and coordinate complex construction sequences without documentation.
  </p>

  <p>
    Working collaboratively with my father, we combined his construction knowledge with my design
    sensibility. Decisions about where to place the island, how to angle the dam, or where to integrate
    trees were made through conversation and continuous site evaluation. This iterative, hands-on
    process allows for responsiveness—the design adapts as the landscape reveals itself during construction.
  </p>

  <h2 class="section-title">Completed Project</h2>
  <p>
    The finished lake system functions exactly as intended: the upper basin catches and moderates
    stormwater, the middle lake stores reserves, and the lower lake provides a stable, beautiful
    water feature that enhances the property year-round. The progression from catch basin to showcase
    creates a narrative through the landscape—each element visible from the others, reinforcing the
    sense of a designed system rather than isolated features.
  </p>

  <p>
    These photos document the entire construction process through completion, showing the project at
    various stages—from raw earthwork to finished stone edges and mature planting. They represent
    the only formal documentation of the work, capturing a project that exists primarily as built
    reality rather than drawn proposal. The sequence demonstrates technical execution, spatial
    planning, and the collaborative process that defines this kind of landscape construction.
  </p>

  <a class="btn" href="/projects.php">Back to all projects</a>
</section>

<?php include __DIR__ . '/../partials/footer.php'; ?>
