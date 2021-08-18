<?php

function getURL($toolName){

	$server = HTTP_SERVER;

    $menu = "<a href='{$server}admin/index.php?t=otut&p={$toolName}'>";
	
	return $menu;
}

?>

<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

<!-- ======= Offering Section ======= -->
<section id="offering" class="offering">
   <div class="container">

      <div class="section-title ">
         <h2>One-time Utility tools </h2>
      </div>

      <div class="row">

         <div class="col-3 offering-card pact" data-aos="fade-up">
            <h5>
               <?php echo getURL('uom-migration') ?> UOM Migration Tool</a>
            </h5>
            <hr>
            <ul>
               <li>
               <?php echo getURL('uom-migration') ?> Migrate the existing UoM attributes data per the UoM attribute standards.</a>
               </li>
               <li>
               <?php echo getURL('uom-migration') ?>Simple and nested attribute migration.</a>
               </li>
            </ul>
         </div>

         <div class="col-3 offering-card pact" data-aos="fade-up">
            <h5>
            <?php echo getURL('data-cleanup') ?> Data Cleanup Tool</a>
            </h5>
            <hr>
            <ul>
            <li>
            <?php echo getURL('data-cleanup') ?> delete attributes with filters</a>
               </li>
            <li>
            <?php echo getURL('data-cleanup') ?>json based config setup</a>
               </li>
            </ul>
         </div>

         <div class="col-3 offering-card pact" data-aos="fade-up">
            <h5>
            <?php echo getURL('date-offset') ?> Date Offset Tool</a>
            </h5>
            <hr>
            <ul>
            <li>
            <?php echo getURL('date-offset') ?> correct the offset value of the date time attributes.</a>
               </li>
            <li>
            <?php echo getURL('date-offset') ?>works on DST logic</a>
               </li>
            </ul>
         </div>

      </div>

      <div class="row">

         <div class="col-3 offering-card pact" id="one" data-aos="fade-up">
            <h5>
               <?php echo getURL('data-collection') ?> Data Collection Tool</a>
            </h5>
            <hr>
            <ul>
               <li>
                  <?php echo getURL('data-collection') ?> Data Collection Tool</a>
               </li>
            </ul>
         </div>

         <div class="col-3 offering-card pact" data-aos="fade-up">
            <h5>
               <?php echo getURL('reference-list-creation') ?> Reference List Creation Tool</a>
            </h5>
            <hr>
            <ul>
               <li>
                  <?php echo getURL('reference-list-creation') ?> Reference List Creation Tool</a>
               </li>
            </ul>
         </div>

         <div class="col-3 offering-card pact" data-aos="fade-up">
            <h5>
               <?php echo getURL('refresh-data-reference') ?> Refresh Data Reference Tool</a>
            </h5>
            <hr>
            <ul>
               <li>
                  <?php echo getURL('refresh-data-reference') ?>Refresh reference data</a>
               </li>
            </ul>
         </div>

      </div>

   </div>
</section>

<!-- End offering Section -->