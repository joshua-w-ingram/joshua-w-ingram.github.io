<?php
$meta = [
  'title' => 'Earlier Experiments in Fabrication and Embedded Systems',
  'date' => '2012-05-01',
  'keywords' => ['fabrication', 'embedded systems', 'prototyping']
];
include __DIR__ . '/../partials/header.php';
?>

<section>
  <!-- Title + date -->
  <h1 class="section-title"><?php echo htmlspecialchars($meta['title']); ?></h1>
  <p class="proj-date"><?php echo htmlspecialchars($meta['date']); ?></p>

  <!-- Intro text ABOVE carousel -->
  <p class="lead">
    A collection of early projects exploring how physical fabrication processes integrate
    with digital control systems. These experiments combined CNC machining, 3D printing,
    and embedded microcontrollers to develop a practical workflow for rapid prototyping.
  </p>

  <p>
    Each prototype tested a different boundary between hardware and software—everything
    from mechanical linkages driven by stepper motors to sensor-driven light systems
    controlled through custom microcontrollers. The focus was on iteration and
    documenting the process rather than polished outcomes.
  </p>

  <!-- Carousel -->
  <div class="carousel">
    <div class="slides">
      <?php
        $folder = __DIR__ . '/../assets/images/earlier-experiments/';
        $webpath = '/assets/images/earlier-experiments/';
        $images = glob($folder . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        sort($images); // alphabetical order (01.jpg, 02.jpg, etc.)
        foreach ($images as $file) {
            $filename = basename($file);
            echo "<img src='{$webpath}{$filename}' alt='Earlier experiment image'>";
        }
      ?>
    </div>
    <button class="prev">❮</button>
    <button class="next">❯</button>
  </div>

  <!-- Carousel script -->
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

  <!-- Additional text BELOW carousel -->
  <p>
    Materials included PLA and TPU prints, machined aluminum brackets, and early PCB breakouts.
    These projects formed the foundation for later production-grade systems by refining toolpaths,
    tolerances, and embedded code structure for reliability and repeatability.
  </p>

  <p>
    Many of these experiments still exist as working prototypes in the shop—each one
    representing a step toward a more integrated relationship between design, fabrication,
    and computation.
  </p>

  <a class="btn" href="/projects.php">Back to all projects</a>
</section>

<?php include __DIR__ . '/../partials/footer.php'; ?>
