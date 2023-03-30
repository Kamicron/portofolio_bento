<?php include('src/commun/header.php'); ?>
<?php include('inc/functions.php'); ?>
<?php include('inc/bdd.php'); ?>

<header class="header">

</header>
<section class="section section--left">
  <div class="information">
    <h1 class="title_bg-black">Ludovic CHEVROULET</h1>
    <div class="profile-icon">
      <img src="asset/photo/ludovic_chevroulet.jpg" alt="Votre nom" width="100%" height="100%">
    </div>
    <div>
      Je suis un développeur junior axé sur le back-end, spécialisé dans la création de sites web efficaces et performants, avec une attention particulière à l'expérience utilisateur. </div>
  </div>
  <div class="contact-form">
    <h2 class="title_bg-black">Contactez-moi</h2>
    <form>
      <div>
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
      </div>
      <button type="submit">Envoyer</button>
    </form>
  </div>
</section>
<section class="section section--right">
  <div class="cv">
    <h2 class="title_bg-white">Mon CV</h2>
    <?php
    $formations = getFormation();
    ?>
    <div class="cv__section">
      <h3 class="cv__section-title">Formation</h3>
      <?php
      foreach ($formations as $keyFormation => $formation) { ?>
        <div class="cv__section-item">
          <h4 class="cv__section-item-title"><?php echo $keyFormation; ?><span class="cv__section-item-title-sperator"> | </span><span class="cv__section-item-date"><?php echo $formation['date']; ?></span></h4>
          <p class="cv__section-item-description"><?php echo $formation['desc_row']; ?></p>
          <ul class="section-item-tags">
            <?php
            foreach ($formation['tag_name'] as $tag) { ?>
              <li class="item-tag"><?php echo $tag; ?></li>
            <?php
            }
            ?>
          </ul>
        </div>
      <?php

        if ($keyFormation !== array_key_last($formations)) {
          echo '<hr class="cv__section-item-separator">';
        }
      }
      ?>
    </div>
    <div class="cv__section">
      <?php $experiences = getExperience(); ?>
      <h3 class="cv__section-title">Expérience professionelles</h3>
      <?php
      foreach ($experiences as $keyExperience => $experience) { ?>
        <div class="cv__section-item">
          <h4 class="cv__section-item-title"><?php echo $keyExperience; ?><span class="cv__section-item-title-sperator"> | </span><span class="cv__section-item-date"><?php echo $experience['date_start'] . " - " . $experience['date_end']; ?></span></h4>
          <p class="cv__section-item-description"><?php echo nl2br($experience['desc_row']); ?></p>
          <ul class="section-item-tags">
            <?php
            foreach ($experience['tag_name'] as $tag) { ?>
              <li class="item-tag"><?php echo $tag; ?></li>
            <?php
            }
            ?>
          </ul>
        </div>
      <?php

        if ($keyExperience !== array_key_last($experiences)) {
          echo '<hr class="cv__section-item-separator">';
        }
      }
      ?>
    </div>
    <?php
    $projects = getProject();

    ?>
    <div class="project">
      <h2 class="title_bg-white">Mes projets</h2>
      <div class="projectWrapper">

        <?php
        foreach ($projects as $keyProject => $project) { ?>
          <div class="project-card">
            <img src="asset/photo/project/<?php echo  $project['name_img']; ?>" alt="<?php echo $project['alt_img']; ?>" width="100%" height="100%">
            <div class="project-info">
              <h3><?php echo  $keyProject; ?></h3>
              <h4><?php echo $project['sub_title_row']; ?></h4>
              <ul class="section-item-tags">
                <?php
                foreach ($project['tag_name'] as $tag) { ?>
                  <li class="item-tag"><?php echo $tag; ?></li>
                <?php
                }
                ?>
              </ul>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
</section>
<?php include('src/commun/footer.php'); ?>