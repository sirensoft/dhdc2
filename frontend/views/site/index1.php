<?php

use scotthuangzl\googlechart\GoogleChart;

$this->title = "District HDC";
?>



<div class="container" style="background-color: lightblue;">

    <div class="row" style="width: 100%">

        <div class="col-lg-4" style="text-align: center">          
            <div style="cursor: pointer">
                <?php
                echo GoogleChart::widget(
                        ['visualization' => 'PieChart',
                            'data' => [
                                ['Task', ''],
                                ['ผ่าน', 80],
                                ['ไม่ผ่าน', 20],
                            ],
                            'options' => [
                                'title' => null,
                                'legend' => 'none',
                                'pieStartAngle' => 100,
                                'colors' => ['#2E5CC7', '#F56527'],
                                'width' => 450,
                                'height' => 400,
                                'showTip' => FALSE,
                                'pieHole' => 0.4,
                            ]
                ]);
                ?>                
            </div>  
            <h4>คุณภาพแฟ้มสะสม</h4>
        </div>

        <div class="col-lg-4" style="text-align: center">          
            <div style="cursor: pointer">
                <?php
                echo GoogleChart::widget(
                        ['visualization' => 'PieChart',
                            'data' => [
                                ['Task', ''],
                                ['ผ่าน', 70],
                                ['ไม่ผ่าน', 30],
                            ],
                            'options' => [
                                'title' => null,
                                'legend' => 'none',
                                'pieStartAngle' => 100,
                                'colors' => ['#2E5CC7', '#F56527'],
                                'width' => 450,
                                'height' => 400,
                                'showTip' => FALSE,
                                'pieHole' => 0.4,
                            ]
                ]);
                ?>                
            </div>  
            <h4>คุณภาพแฟ้มบริการ</h4>
        </div>

        <div class="col-lg-4" style="text-align: center">          
            <div style="cursor: pointer">
                <?php
                echo GoogleChart::widget(
                        ['visualization' => 'PieChart',
                            'data' => [
                                ['Task', ''],
                                ['ผ่าน',90],
                                ['ไม่ผ่าน', 10],
                            ],
                            'options' => [
                                'title' => null,
                                'legend' => 'none',
                                'pieStartAngle' => 100,
                                'colors' => ['#2E5CC7', '#F56527'],
                                'width' => 450,
                                'height' => 400,
                                'showTip' => FALSE,
                                'pieHole' => 0.4,
                            ]
                ]);
                ?>                
            </div>  
            <h4>คุณภาพแฟ้มบริการกึ่งสำรวจ</h4>
        </div>


    </div>




</div>

