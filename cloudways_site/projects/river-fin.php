<?php
$meta = [
  'title' => 'Daedal Industries — River Fin Development',
  'date' => '2024-09-05',
  'keywords' => ['materials engineering','urethane casting','product design','surface finishing','prototyping']
];
include __DIR__ . '/../partials/header.php';
?>

<section>
  <h1 class="section-title"><?php echo htmlspecialchars($meta['title']); ?></h1>
  <p class="proj-date"><?php echo htmlspecialchars($meta['date']); ?></p>

  <p class="lead">
    The River Fin began as a flexible 3D-printed concept and evolved into a cast-urethane,
    dip-coated production part.  What started on the printer bench became a full material
    and process study—an exploration of how geometry, chemistry, and temperature could
    cooperate to produce a resilient, manufacturable fin for real-world water use.
  </p>

  <h2 class="section-title">Printed Origins</h2>
  <p>
    Early fins were printed in TPU to study hydrodynamic flex and recovery.
    Each prototype varied infill, wall thickness, and grain direction to tune
    stiffness.  The prints confirmed that a fin could flex without losing thrust,
    but they also exposed limits: TPU softened under heat, distorted in storage,
    and carried visible layer lines.  It proved the geometry, not the product.
    The next step was manufacturability—how to capture that same elasticity in
    a toolable material.
  </p>

  <h2 class="section-title">From Print to Mold</h2>
  <p>
    The transition led to machined <strong>6061 aluminum molds</strong> and
    <strong>BJB CF-95AF polyurethane</strong>, a 95-shore-A elastomer chosen for
    its toughness-to-flex ratio.  Alignment pins, clamps, and jack-screw points
    were added to produce two to four fins per day.  Mix ratios were refined to
    <em>50 : 100 by weight</em>, curing was staged at 75 °F ambient followed by
    a 110 °F post-cure.  Controlled cooling exploited the thermal-expansion
    mismatch between urethane and aluminum—roughly eight-to-one—to release the
    fin cleanly without tearing.
  </p>

  <div class="carousel">
    <div class="slides">
      <?php
        $folder = __DIR__ . '/../assets/images/river-fin/';
        $webpath = '/assets/images/river-fin/';
        $images = glob($folder . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        sort($images);
        foreach ($images as $file) {
          $filename = basename($file);
          echo "<img src='{$webpath}{$filename}' alt='River Fin process image'>";
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

  <h2 class="section-title">Surface Finishing: The Permalac Trials</h2>
  <p>
    With casting reliable, attention turned to finish quality.  The goal was a
    UV-resistant, semi-gloss skin that preserved flexibility.  You built a
    sealed dip-tank from a 30-caliber ammo can and filled it with
    <strong>Permalac NT Semigloss</strong> thinned 12–15 % with xylene—just
    enough to flow evenly and minimize waste from a material that costs
    about $225 per gallon.
  </p>

  <p>
    Each fin was lowered and raised on a small dipping rig at constant speed,
    drained two minutes, and cured dust-free.  The coating looked invisible but
    formed a tough, flexible shell.  You tracked weight gain per fin to gauge
    film thickness and cost: roughly 5 mL uptake—around $0.30 per fin—well
    within target economics.
  </p>

  <h2 class="section-title">Setbacks and Refinement</h2>
  <p>
    A mis-mixed batch of resin left a gummy mess in the mold and forced a full
    teardown: xylene scrub, re-polish, five-layer wax rebuild.  That failure
    crystallized the discipline that followed—precise mixing, timed haze,
    temperature control, and ritualized mold prep.  Every variable became data.
  </p>

  <p>
    Heat experiments showed that maintaining molds at
    <strong>100–120 °F</strong> cut cure time to 45 minutes without
    dimensional drift.  Adding a fan-assisted aluminum heat-sink reduced
    cool-down to under an hour, doubling throughput.  Each iteration turned
    frustration into repeatability.
  </p>

  <h2 class="section-title">Economics and Process Control</h2>
  <p>
    Permalac’s self-leveling nature meant nearly zero waste but demanded
    sealed storage to prevent solvent loss.  The ammo-can dip tank, covered
    with plastic film between uses, kept the bath viable for weeks.  The
    process now runs as a closed cycle: pour, cure, post-heat, dip, hang,
    and package—all inside 48 hours.
  </p>

  <h2 class="section-title">Lessons and Outlook</h2>
  <ul>
    <li>Thermal contraction, not force, is the safest release method.</li>
    <li>Wax film uniformity dictates surface quality more than quantity.</li>
    <li>Controlled temperature eliminates nearly all tearing events.</li>
    <li>Vacuum mixing and air-assist demold are next-phase improvements.</li>
  </ul>

  <p>
    The River Fin project demonstrates how a simple printed prototype can
    evolve into a fully engineered casting line.  From the first TPU print to
    the solvent-sealed dip tank, every step narrowed the gap between craft and
    production.  Daedal Industries now operates not just as a maker of fins,
    but as a builder of manufacturing methods.
  </p>

  <a class="btn" href="/projects.php">Back to all projects</a>
</section>

<?php include __DIR__ . '/../partials/footer.php'; ?>
