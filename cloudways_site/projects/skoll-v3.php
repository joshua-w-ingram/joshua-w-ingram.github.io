<?php
$meta = [
  'title' => 'Flynoceros Sköll V3 — Evolution of a Freestyle Platform',
  'date' => '2024-04-20',
  'keywords' => ['freestyle', 'drone frame', 'product design', 'iteration', 'aerospace']
];
include __DIR__ . '/../partials/header.php';
?>

<section>
  <h1 class="section-title"><?php echo htmlspecialchars($meta['title']); ?></h1>
  <p class="proj-date"><?php echo htmlspecialchars($meta['date']); ?></p>

  <p class="lead">
    The Sköll V3 represents the third generation of a design lineage dedicated to refining how
    a freestyle drone feels and survives in flight. From rigid, vibration-prone prototypes to
    a dampened, modular architecture, it embodies years of iterative engineering and field testing.
  </p>

  <h2 class="section-title">Design Evolution</h2>
  <p>
    The first Sköll frames used hard-mounted side plates and direct camera mounts — strong but
    unforgiving. Early flights exposed resonance issues that affected both flight feel and video
    quality. Through successive iterations, every crash and rebuild informed a clearer goal:
    a frame that would absorb vibration instead of amplifying it.
  </p>

  <p>
    The breakthrough arrived with V3’s <strong>soft-mounted rollcage system</strong>. 
    The camera and stack are now isolated from the frame, producing clean footage and a
    smooth, “locked-in” response in flight. Impacts dissipate through the mounts, protecting
    electronics and keeping geometry intact even after heavy crashes.
  </p>

  <h2 class="section-title">System Expansion</h2>
  <p>
    What began as a single frame grew into a full family of airframes — the
    <em>Specialist</em>, <em>Low Void</em>, and <em>Classic</em> variants — ranging from
    5-inch freestyle builds to 8-inch long-range rigs. Each version shares the same design
    DNA: modular components, standardized geometry, and compatibility across sizes.
  </p>

  <p>
    This expansion transformed Flynoceros from a single product into a platform.
    Accessories and mounts fit every version, allowing pilots to customize and rebuild
    without redesigning. The result is a frame ecosystem that encourages experimentation.
  </p>

  <!-- Carousel -->
  <div class="carousel">
    <div class="slides">
      <?php
        $folder = __DIR__ . '/../assets/images/skoll-v3/';
        $webpath = '/assets/images/skoll-v3/';
        $images = glob($folder . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        sort($images);
        foreach ($images as $file) {
          $filename = basename($file);
          echo "<img src='{$webpath}{$filename}' alt='Sköll V3 image'>";
        }
      ?>
    </div>
    <button class="prev">❮</button>
    <button class="next">❯</button>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", function(){
    const carousel = document.querySelector('.carousel');
    const slidesContainer = carousel.querySelector('.slides');
    const slides = slidesContainer.querySelectorAll('img');
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

  <h2 class="section-title">Design for Access and Maintenance</h2>
  <p>
    Every component of the V3 can be serviced without tearing the frame apart. Arms slide out
    with two bolts, and the rollcage can pivot or detach entirely with minimal hardware.
    These refinements reflect countless field repairs and late-night rebuilds — the realities
    of prototyping in the field.
  </p>

  <p>
    The design minimizes fasteners and maximizes access, embodying the “build-repair-fly”
    rhythm that drives continuous improvement.
  </p>

  <h2 class="section-title">Compatibility and Ecosystem</h2>
  <p>
    The Sköll V3 supports both analog and digital FPV systems, with printable mounts for new
    hardware as technology evolves. Over time, an entire library of accessories — camera
    housings, battery plates, antenna mounts — emerged, each one extending the frame’s lifespan
    and usefulness.
  </p>

  <h2 class="section-title">Reflection</h2>
  <p>
    The Sköll V3 is less a product and more a record of persistence. Each version captures
    lessons about vibration control, modular assembly, and manufacturability. It’s the
    embodiment of iterative design: the quiet craft of improving a single idea until it
    feels inevitable.
  </p>

  <a class="btn" href="/projects.php">Back to all projects</a>
</section>

<?php include __DIR__ . '/../partials/footer.php'; ?>
