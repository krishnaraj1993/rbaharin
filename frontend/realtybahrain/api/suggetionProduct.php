<?php
$url = 'http://localhost:8000/api/properties/search?'.$_SERVER['QUERY_STRING'];
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
$products = json_decode($response, true)['data'];
foreach ($products as $key => $product) {
    ?>
    
    
<li class="col-lg-6">
    <div class="property_box wow fadeInUp">
        <div class="propertyImg"><img alt="" src="http://localhost:8000/<?php echo $product['assets']; ?>"></div>
        <h3><a href="#"><?php echo $product['Title']; ?></a></h3>
        <div class="property_location"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
            <?php echo $product['location']; ?>
        </div>
        <div class="heart_info">
            <div class="heart_icon"><a href="#"><i class="fas fa-heart" aria-hidden="true"></i></a></div>
            <div class="heart_icon exchange_icon"><a href="#"><i class="fas fa-exchange-alt"></i></a></div>
            <div class="property_price">BHD <?php echo $product['investment']; ?></div>
        </div>
        <div class="propert_info">
            <ul class="row">
                <li class="col-4">
                    <div class="proprty_icon"><img alt="" src="images/bedroom_icon.png"></div>
                    <h5>Bedrooms</h5>
                </li>
                <li class="col-4">
                    <div class="proprty_icon"><img alt="" src="images/bathroom_icon.png"></div>
                    <h5>Bathrooms</h5>
                </li>
                <li class="col-4">
                    <div class="proprty_icon"><img alt="" src="images/area_icon.png" width="24px"></div>
                    <h5>Area</h5>
                </li>
            </ul>
        </div>
        <div class="rent_info">
            <div class="apart">Apartment</div>
            <div class="sale">For Sale</div>
        </div>
    </div>
</li>
<?php
}
?>