  <?php  //$latLng = $helper->get_lat_long($building[0]->StreetName.' '.$building[0]->HouseNumber.' '.$building[0]->City_Name.' '.$building[0]->Postal_code) ;
 
    ?>
@if(isset($getLatLng) && !empty($getLatLng))
<script type="text/javascript">
var  markerMapData = <?php echo $getLatLng; ?> ;
</script>
@else
<script type="text/javascript">
var  markerMapData = '';
</script>
@endif