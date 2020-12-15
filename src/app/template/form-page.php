<style>
    .content {
        max-width: 500px;
        margin: 0 auto;
    }
    .field-row {
        margin-bottom: 2px;
        margin-top: 10px;
    }

    .result-block {
        margin-top: 10px;
    }

    .result-block p {
        margin: 0;
    }

    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
        margin: 0;
    }

    .error-message {
        color: red;
    }
    .send-button {
        margin: 10px 0;
    }
</style>

<div class="content">
    <?php if (array_key_exists('error_msg', $data)) : ?>
        <div class="error-message">
            <?php echo str_replace("\r\n", "<br>", $data['error_msg']) ?>
        </div>
    <?php endif ?>
    <form method="POST">
        <p class="field-row">
            Point A:
        </p>
        <label for="a-point-latitude">
            Latitude
        </label>
        <input 
            id="a-point-latitude" 
            name="gps-coors[a-point-latitude]" 
            type="number"
            value="<?php echo (array_key_exists('gps-coors', $_REQUEST) && array_key_exists('a-point-latitude', $_REQUEST['gps-coors'])) ? $_REQUEST['gps-coors']['a-point-latitude'] : '' ?>" />
        
        <label for="a-point-longitude">
            Longitude
        </label>
        <input 
            id="a-point-longitude"
            name="gps-coors[a-point-longitude]"
            type="number"
            value="<?php echo (array_key_exists('gps-coors', $_REQUEST) && array_key_exists('a-point-longitude', $_REQUEST['gps-coors'])) ? $_REQUEST['gps-coors']['a-point-longitude'] : '' ?>"
        />
        
        <p class="field-row">
            Point B:
        </p>
        <label for="b-point-latitude">
            Latitude
        </label>
        <input 
            id="b-point-latitude"
            name="gps-coors[b-point-latitude]"
            type="number" 
            value="<?php echo (array_key_exists('gps-coors', $_REQUEST) && array_key_exists('b-point-latitude', $_REQUEST['gps-coors'])) ? $_REQUEST['gps-coors']['b-point-latitude'] : '' ?>"
        />
        
        <label for="b-point-longitude">
            Longitude
        </label>
        <input 
            id="b-point-longitude" 
            name="gps-coors[b-point-longitude]" 
            type="number" 
            value="<?php echo (array_key_exists('gps-coors', $_REQUEST) && array_key_exists('b-point-longitude', $_REQUEST['gps-coors'])) ? $_REQUEST['gps-coors']['b-point-longitude'] : '' ?>"
        />
    
        <input type="submit" value="Calculate" class="send-button" />
    </form>
    <div class="result-block">
        <p>
            2.
        </p>
        <p>
            Point C:
        </p>
        <p>
            Point D:
        </p>
    </div>
    <div class="result-block">
        <p>
            3.
        </p>
        <p>
            Perimeter: 0 meter
        </p>
    </div>
    <div class="result-block">
        <p>
            4.
        </p>
        <p>
            Area: 0 squaremeter
        </p>
    </div>
    <div class="result-block">
        <p>
            5.
        </p>
        <p>
            Total cost: 0 EUR
        </p>
    </div>

</div>