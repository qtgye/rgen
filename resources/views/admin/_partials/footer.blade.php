
  </section>
  <!-- container section start -->

    <!-- javascripts -->
  <script src="/back/js/jquery.js"></script>
	<script src="/back/js/jquery-ui-1.10.4.min.js"></script>
  <script src="/back/js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="/back/js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="/back/js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="/back/js/jquery.scrollTo.min.js"></script>
  <script src="/back/js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="/back/assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="/back/js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="/back/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="/back/js/owl.carousel.js" ></script>
  <!-- jQuery full calendar -->
  <<script src="/back/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
	<script src="/back/assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
  <!--script for this page only-->
  <script src="/back/js/calendar-custom.js"></script>
	<script src="/back/js/jquery.rateit.min.js"></script>
  <!-- custom select -->
  <script src="/back/js/jquery.customSelect.min.js" ></script>
	<script src="/back/assets/chart-master/Chart.js"></script>

  <!-- custom script for this page-->
  <script src="/back/js/sparkline-chart.js"></script>
  <script src="/back/js/easy-pie-chart.js"></script>
	<script src="/back/js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="/back/js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="/back/js/xcharts.min.js"></script>
	<script src="/back/js/jquery.autosize.min.js"></script>
	<script src="/back/js/jquery.placeholder.min.js"></script>
	<script src="/back/js/gdp-data.js"></script>	
	<script src="/back/js/morris.min.js"></script>
	<script src="/back/js/sparklines.js"></script>	
	<script src="/back/js/charts.js"></script>
	<script src="/back/js/jquery.slimscroll.min.js"></script>

  <!--custom checkbox & radio-->
  <script src="/back/js/ga.js"></script>
  <!--custom switch-->
  <script src="/back/js/bootstrap-switch.js"></script>
  <!--custom tagsinput-->
  <script src="/back/js/jquery.tagsinput.js"></script>
  
  <!-- colorpicker -->
 
  <!-- bootstrap-wysiwyg -->
  <script src="/back/js/jquery.hotkeys.js"></script>
  <script src="/back/js/bootstrap-wysiwyg.js"></script>
  <script src="/back/js/bootstrap-wysiwyg-custom.js"></script>
  <!-- ck editor -->
  <script src="/back/assets/ckeditor/ckeditor.js"></script>
  <!-- custom form component script for this page-->
  <script src="/back/js/form-component.js"></script>

  <!--custome script for all page-->
  <script src="/back/js/scripts.js"></script>
  <script src="/back/js/_build.js"></script>

  <script>
  //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

      // CK Editor
      CKEDITOR.replaceAll('ckeditor');
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});



  </script>

  </body>
</html>