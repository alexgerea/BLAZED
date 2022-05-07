<?php
    function component($numeprodus,$pretprodus,$imagineprodus,$idprodus){
        $element = "
        <form action=\"#\" method=\"post\">
        <div class=\"box\">
            <div class=\"image\">
                <img src=\"$imagineprodus\">
            </div>
            <div class=\"info\">
                <div class=\"subinfo\">
                    <h3 class=\"title\">$numeprodus</h3>
                    <div class=price><span>$pretprodus lei</span></div>
                    <div class=\"price\">$pretprodus lei</div>
                    <button type=\"submit\" class=\"add\" name=\"add\">Adauga in cos</button>
                    <input type='hidden' name='idprodus' value='$idprodus'>
                </div>
            </div>
        </div>
        </form>
        ";
    echo $element;
    }

    function cartElement($imagineprodus, $numeprodus,$pretprodus,$idprodus){
        $element= "          
        <form action=\"cosdecumparaturi.php?action=remove&id=$idprodus\" method=\"post\" class=\"cart-items\">
            <div class=\"product\">
                <img src=\"$imagineprodus\">
                <div class=\"product-info\">
                    <h3 class=\"product-name\">$numeprodus</h3>
                    <h2 class=\"product-price\">$pretprodus lei</h2>
                    <h2 class=\"product-offer\"> </h2>
                    <p class=\"product-quantity\">Cantitate: <input type=\"text\" value=\"1\" name=\"\"></p>
                    <button type=\"submit\" name=\"remove\" class=\"remove-button\">
                        <p class=\"product-remove\">
                        <i class=\"fa-solid fa-trash\"></i>
                        <span class=\"remove\">Șterge</span></input>
                    </p>
                    </button>
                </div>
            </div>
        </form>";
        echo $element;
    }
?>

