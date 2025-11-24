<?php
$meta = [
  'title' => 'Portfolio 2009 — Interactive Installations & Web Platforms',
  'date' => '2009-12-01',
  'keywords' => ['interactive installation', 'hardware', 'arduino', 'web platform', 'entrepreneurship', 'sound art']
];
include __DIR__ . '/../partials/header.php';
?>

<section>
  <h1 class="section-title"><?php echo htmlspecialchars($meta['title']); ?></h1>
  <p class="proj-date"><?php echo htmlspecialchars($meta['date']); ?></p>

  <p class="lead">
    This year focused on applying computer science to physical and social systems. Two major projects
    demonstrate a range of skills: an agent-based hardware installation exploring sound interaction,
    and a web platform addressing economic challenges. Both projects were developed independent of
    my work at Skidmore Owings & Merrill, showing commitment to pursuing challenging new ideas.
  </p>

  <h2 class="section-title">Sonotrophs — Interactive Sound Installation</h2>
  <p>
    Developed for exhibition in the Sullivan Galleries at The School of the Art Institute of Chicago
    (September 2009 - January 2010) and the ACADIA 2009 conference. The installation had to work in
    any exhibit space, include interaction, and relate to Chicago. The concept plays on Chicago's nickname
    "The Windy City" — originally referring to long-winded politicians rather than weather. The Sonotrophs
    are blown by sound waves as a virtual wind.
  </p>

  <p>
    <strong>Technical Design:</strong> Each pod consists of a vacuum-formed polystyrene shell (27 side pieces,
    9 bottom pieces) with an embedded parabolic surface that reflects sound waves into a microphone.
    Servo motors shift the center pendulum to tilt the pod in response to sound intensity and direction.
    The pods were modeled virtually, milled from MDF, vacuum formed, then trimmed using jigs created from
    the virtual model.
  </p>

  <p>
    <strong>Electronics:</strong> Arduino-based system with custom circuit boards. Using pre-built breakout boards
    for microphones and battery chargers, combined with balancing and normalization algorithms in code,
    simplified the circuit design. Each pod operates independently while responding to the collective sound environment.
  </p>

  <p>
    <strong>Collaboration:</strong> Developed with colleagues Sonal Beri, Justin Nardone, and Doug Pancoast.
    The project demonstrates hardware fabrication, embedded systems programming, sound processing, and
    spatial interaction design.
  </p>

  <h2 class="section-title">layoffmoveon.com — Community Platform for Economic Recovery</h2>
  <p>
    In early 2008, my partner and I started Euclid-Circle LLC to create a space where people suffering
    from economic decline could vent, find comfort, seek advice, and share stories. The site addresses
    both emotional and practical needs during job loss and recovery.
  </p>

  <p>
    <strong>Platform Structure:</strong> Two distinct profile types serve different stages of recovery.
    The layoff profile allows expression of emotions tied to job loss and seeking support. The moveon
    profile enables people who've recovered to share success stories and help others. This dual approach
    acknowledges that job loss involves distinct emotional phases.
  </p>

  <p>
    <strong>Context:</strong> Launched during peak unemployment (10%+ in many regions), the platform filled
    a gap in resources for those affected by the 2008 economic crisis. The site was funded through advertising
    and developed to scale with growing user needs.
  </p>

  <p>
    <strong>Development:</strong> Built in 3 months with partner Jessica Lybeck, freelance web consultant Brett Mackie,
    and intern Kristin Hall. The rapid development timeline required clear prioritization and agile decision-making.
  </p>

  <p>
    <strong>Media Coverage:</strong> Featured in The Wall Street Journal, Crain's Business Chicago, Time-Out Chicago,
    Examiner.com, and MSN.com. The press coverage validated the platform's relevance and brought increased
    visibility to the service.
  </p>

  <p>
    <strong>Impact:</strong> The site provided community support during a critical economic period, demonstrating
    how web platforms can address social needs. New members continued joining regularly, showing sustained
    demand for peer support during job transitions.
  </p>

  <h2 class="section-title">Reflection</h2>
  <p>
    These projects represent different scales of intervention — one physical and experiential, one digital
    and social. Both required systems thinking: understanding how individual agents (pods, users) create
    collective behavior, how technical constraints shape design decisions, and how rapid prototyping
    and iteration lead to successful outcomes. The work demonstrates comfort moving between hardware,
    software, design, and entrepreneurship.
  </p>

  <!-- Carousel -->
  <div class="carousel">
    <div class="slides">
      <?php
        $folder = __DIR__ . '/../assets/images/portfolio-2009(1)/';
        $webpath = '/assets/images/portfolio-2009(1)/';
        if (is_dir($folder)) {
          $images = glob($folder . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
          sort($images);
          foreach ($images as $file) {
            $filename = basename($file);
            echo "<img src='{$webpath}{$filename}' alt='Portfolio 2009 image'>";
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

  <a class="btn" href="/projects.php">Back to all projects</a>
</section>

<?php include __DIR__ . '/../partials/footer.php'; ?>
