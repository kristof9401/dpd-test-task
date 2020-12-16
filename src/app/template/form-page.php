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
            value="<?php echo (array_key_exists('gps-coors', $_REQUEST) && array_key_exists('a-point-latitude', $_REQUEST['gps-coors'])) ? $_REQUEST['gps-coors']['a-point-latitude'] : '' ?>" 
            step="any"
            min="-90"
            max="90"
        />
        
        <label for="a-point-longitude">
            Longitude
        </label>
        <input 
            id="a-point-longitude"
            name="gps-coors[a-point-longitude]"
            type="number"
            value="<?php echo (array_key_exists('gps-coors', $_REQUEST) && array_key_exists('a-point-longitude', $_REQUEST['gps-coors'])) ? $_REQUEST['gps-coors']['a-point-longitude'] : '' ?>"
            step="any"
            min="-180"
            max="180"
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
            step="any"
            min="-90"
            max="90"
        />
        
        <label for="b-point-longitude">
            Longitude
        </label>
        <input 
            id="b-point-longitude" 
            name="gps-coors[b-point-longitude]" 
            type="number" 
            value="<?php echo (array_key_exists('gps-coors', $_REQUEST) && array_key_exists('b-point-longitude', $_REQUEST['gps-coors'])) ? $_REQUEST['gps-coors']['b-point-longitude'] : '' ?>"
            step="any"
            min="-180"
            max="180"
        />
        
        <input type="submit" value="Calculate" class="send-button" />
    </form>
    <div class="result-block">
        <p>
            2.
        </p>
        <p>
            Point C: 
            <span>
                <?php echo array_key_exists('c_coors', $data) ? $data['c_coors'] : '' ?>
            </span>
        </p>
        <p>
            Point D: 
            <span>
                <?php echo array_key_exists('d_coors', $data) ? $data['d_coors'] : '' ?>
            </span>
        </p>
    </div>
    <div class="result-block">
        <p>
            3.
        </p>
        <p>
            Perimeter: <?php echo array_key_exists('perimeter', $data) ? $data['perimeter'] : '' ?> meter
        </p>
    </div>
    <div class="result-block">
        <p>
            4.
        </p>
        <p>
            Area: <?php echo array_key_exists('area', $data) ? $data['area'] : '' ?> squaremeter
        </p>
    </div>
    <div class="result-block">
        <p>
            5.
        </p>
        <p>
            Total cost: <?php echo array_key_exists('full_cost', $data) ? $data['full_cost'] : '' ?> EUR
        </p>
    </div>

</div>