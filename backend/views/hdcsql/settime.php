<?php

use kartik\time\TimePicker;
?>

<div style="padding: 20px">
<?php
echo '<label>Start Time</label>';
echo TimePicker::widget([
    'name' => 'start_time',
    'value' => '21:00',
    'pluginOptions' => [
        'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 1,
        'secondStep' => 5,
    ]
]);

?>
</div>

