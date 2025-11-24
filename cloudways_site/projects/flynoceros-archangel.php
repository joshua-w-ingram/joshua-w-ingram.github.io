<?php
$meta = [
  'title' => 'Flynoceros — Archangel Production Facility Build-Out',
  'date' => '2020-03-15',
  'keywords' => ['manufacturing', 'facility design', 'production management', 'drone systems']
];
include __DIR__ . '/../partials/header.php';
?>

<section>
  <h1 class="section-title"><?php echo htmlspecialchars($meta['title']); ?></h1>
  <p class="proj-date"><?php echo htmlspecialchars($meta['date']); ?></p>

  <p class="lead">
    What began as a small drone design company became a full-fledged manufacturing operation.
    The Archangel project required a complete product line and the infrastructure to build it.
    Within months, Flynoceros transformed an old New Braunfels house into a functioning
    micro-factory—staffed, supplied, and capable of delivering two thousand drones under contract.
  </p>

  <h2 class="section-title">From Concept to Contract</h2>
  <p>
    By 2019, Flynoceros had evolved from a one-man design studio into a recognizable brand.
    A new client, David from Austin, founded <strong>Archangel</strong> with the goal of
    launching a consumer-grade drone platform.  He needed an entire system: four frame sizes,
    integrated electronics, and retail packaging.  Flynoceros designed and sourced everything—
    from the carbon-fiber structures to the embedded lighting and power systems.
  </p>

  <p>
    Each frame featured <strong>soft-mounted LED boards</strong> developed in collaboration
    with a PCB factory, a <strong>custom flight controller</strong> built to exact size
    constraints, and a matching four-in-one ESC.  Even the straps, stickers, and artwork were
    bespoke, with illumination designed to shine through printed graphics.
    The initial production run was contracted at <strong>2,000 units</strong>—a project
    valued at roughly one million dollars.
  </p>

  <h2 class="section-title">Building the Facility</h2>
  <p>
    To meet production demand, an entire house was reconfigured into a manufacturing plant.
    The front room became reception, the kitchen served as a break area, and the large
    master bedroom was converted into the assembly floor.  A 40-foot shipping container
    on site stored materials and inventory, while a dedicated green-screen media room
    handled product photography and video content.
  </p>

  <p>
    The setup included soldering stations, test rigs, packaging tables, and a small logistics
    area for fulfillment.  The back shop behind the property continued to handle R&amp;D and
    frame prototyping.  The transformation required city approval and creative problem-solving
    to achieve partial commercial compliance in a residential zone—a feat in itself.
  </p>

  <div class="carousel">
    <div class="slides">
      <?php
        $folder = __DIR__ . '/../assets/images/flynoceros-archangel/';
        $webpath = '/assets/images/flynoceros-archangel/';
        $images = glob($folder . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        sort($images);
        foreach ($images as $file) {
          $filename = basename($file);
          echo "<img src='{$webpath}{$filename}' alt='Flynoceros Archangel project image'>";
        }
      ?>
    </div>
    <button class="prev">❮</button>
    <button class="next">❯</button>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded",function(){
    const c=document.querySelector('.carousel'),
          s=c.querySelector('.slides'),
          imgs=s.querySelectorAll('img'),
          prev=c.querySelector('.prev'),
          next=c.querySelector('.next');
    let i=0;
    function show(n){i=(n+imgs.length)%imgs.length;
      s.style.transform=`translateX(${-i*100}%)`;}
    prev.addEventListener('click',()=>show(i-1));
    next.addEventListener('click',()=>show(i+1));
    show(0);
  });
  </script>

  <h2 class="section-title">Production and Challenges</h2>
  <p>
    With the facility ready, six assembly technicians were hired and trained.  Components
    arrived from multiple suppliers, coordinated through detailed spreadsheets of cost and
    lead-time.  A manufacturing timeline mapped every phase—from PCB arrival to final packaging.
    Early runs hit setbacks when flight-controller voltage regulators failed in testing.
    The boards were re-engineered and replaced within weeks, keeping the client’s sales
    schedule intact under a formal change-request update.
  </p>

  <p>
    Each drone shipped in a consumer-grade box with custom foam inserts, printed literature,
    and serialized labels.  Every detail—from the carbon-fiber chamfer to the packaging
    typography—was produced in-house.  The team delivered all 2,000 units successfully.
  </p>

  <h2 class="section-title">Outcome and Reflection</h2>
  <p>
    The Archangel build-out proved that small teams can manufacture at commercial scale when
    process and environment are designed together.  The project united sourcing, mechanical
    design, electrical integration, and facility planning under one roof.  It ended only when
    COVID-19 shuttered markets and halted follow-on orders—but the facility itself stood as
    proof that Flynoceros could grow from boutique brand to full production house.
  </p>

  <a class="btn" href="/projects.php">Back to all projects</a>
</section>

<?php include __DIR__ . '/../partials/footer.php'; ?>
