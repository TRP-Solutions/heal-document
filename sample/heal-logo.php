<?php
/*
HealDocument is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/heal-document/blob/master/LICENSE.txt
*/
require_once "../lib/HealSVG.php";
header("Content-Type: image/svg+xml");

$doc = new HealSVG();
$svg = $doc->svg(614,310);

$dark = ['fill'=>'#333333'];
$grey = ['fill'=>'#656565'];

$top = "6.702";
$upper = "56.136";
$uppermid = "72.792";
$lowermid = "123.297";
$lower = "146.67";
$base = "196.91";

// Dark HE
$polygon = $svg->el("polygon",$dark);
$polygon->at(["points"=>"139.542,$top"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"128.257,$uppermid"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"99.78,$uppermid"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"111.333,$top"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"55.72,$top"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"22.676,$base"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"78.556,$base"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"91.452,$lowermid"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"119.661,$lowermid"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"106.765,$base"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"314.285,$base"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"322.883,$lower"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"272.913,$lower"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"288.764,$upper"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"333.627,$upper"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"342.225,$top"],HEAL_ATTR_APPEND);

// Blue +
$polygon = $svg->el("polygon",['fill'=>'#007AC3']);
$polygon->at(["points"=>"287.672,61.952"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"285.701,$uppermid"],HEAL_ATTR_APPEND); // orig y: 72.465
$polygon->at(["points"=>"232.204,$uppermid"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"243.629,$top"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"195.958,$top"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"184.533,$uppermid"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"128.257,$uppermid"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"119.661,$lowermid"],HEAL_ATTR_APPEND); // orig y: 123.568
$polygon->at(["points"=>"175.655,$lowermid"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"162.914,$base"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"210.585,$base"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"223.326,$lowermid"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"277,$lowermid"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"274,138.99"],HEAL_ATTR_APPEND);
$polygon->at(["points"=>"319.853,106.82"],HEAL_ATTR_APPEND);

// Dark A
$path = $svg->el("path",$dark);
$path->at(["d"=>"M422.816,168.972"],HEAL_ATTR_APPEND);
$path->at(["d"=>"H388.7"],HEAL_ATTR_APPEND);
$path->at(["d"=>"L378.76,$base"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-58.567"],HEAL_ATTR_APPEND);
$path->at(["d"=>"L400.251,$top"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h69.581"],HEAL_ATTR_APPEND);
$path->at(["d"=>"L479.772,$base"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-56.956"],HEAL_ATTR_APPEND);
$path->at(["d"=>"z"],HEAL_ATTR_APPEND);

$path->at(["d"=>"M402.132,126.254"],HEAL_ATTR_APPEND); 
$path->at(["d"=>"h21.493"],HEAL_ATTR_APPEND);
$path->at(["d"=>"V63.658"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-1.076z"],HEAL_ATTR_APPEND);

// Dark L
$path = $svg->el("path",$dark);
$path->at(["d"=>"M599.055,$base"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-105.85"],HEAL_ATTR_APPEND);
$path->at(["d"=>"L526.25,$top"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h56.687"],HEAL_ATTR_APPEND);
$path->at(["d"=>"l-23.911,138.356"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h49.163z"],HEAL_ATTR_APPEND);

// Grey D
$path = $svg->el("path",$grey);
$path->at(["d"=>"M76.342,248.348"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c0,6.581-0.79,13.251-2.369,20.007"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-1.58,6.758-4.168,12.855-7.766,18.296"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-3.599,5.441-8.337,9.894-14.215,13.359"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-5.88,3.468-13.163,5.199-21.85,5.199"],HEAL_ATTR_APPEND);
$path->at(["d"=>"H3.159"],HEAL_ATTR_APPEND);
$path->at(["d"=>"l16.189-93.189"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h24.614"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c5.792,0,10.748,0.878,14.874,2.632"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c4.124,1.757,7.48,4.234,10.069,7.437"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c2.587,3.205,4.475,7.042,5.66,11.518"],HEAL_ATTR_APPEND);
$path->at(["d"=>"S76.342,242.996,76.342,248.348z"],HEAL_ATTR_APPEND);

$path->at(["d"=>"M55.677,250.02"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c0-2.908-0.243-5.619-0.724-8.132"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-0.483-2.512-1.273-4.671-2.369-6.479"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-1.098-1.806-2.501-3.239-4.212-4.296"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-1.711-1.058-3.797-1.588-6.252-1.588"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-5.66"],HEAL_ATTR_APPEND);
$path->at(["d"=>"l-10.003,58.178"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h5.923"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c3.86,0,7.239-1.146,10.135-3.437"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c2.896-2.291,5.331-5.245,7.305-8.86"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c1.974-3.613,3.443-7.646,4.409-12.097"],HEAL_ATTR_APPEND);
$path->at(["d"=>"C55.194,258.858,55.677,254.429,55.677,250.02z"],HEAL_ATTR_APPEND);

// Grey O
$path = $svg->el("path",$grey);
$path->at(["d"=>"M155.315,245.451 c0,7.635-1.01,15.16-3.027,22.574 c-2.02,7.416-4.893,14.062-8.622,19.94"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-3.73,5.88-8.292,10.619-13.688,14.216 c-5.397,3.597-11.474,5.396-18.23,5.396 c-4.739,0-8.973-0.855-12.702-2.566"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-3.73-1.711-6.867-4.124-9.411-7.239 c-2.546-3.114-4.475-6.845-5.791-11.188"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-1.316-4.344-1.975-9.19-1.975-14.544 c0-7.635,0.987-15.181,2.961-22.64"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c1.975-7.457,4.825-14.127,8.556-20.007 c3.729-5.878,8.292-10.639,13.689-14.281"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c5.396-3.641,11.517-5.463,18.362-5.463 c5.001,0,9.366,0.856,13.096,2.567"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c3.729,1.711,6.845,4.146,9.346,7.305 c2.5,3.159,4.364,6.933,5.594,11.32"],HEAL_ATTR_APPEND);
$path->at(["d"=>"C154.701,235.23,155.315,240.101,155.315,245.451z M134.387,248.348"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c0-2.456-0.177-4.87-0.526-7.239 c-0.352-2.37-0.944-4.431-1.777-6.187"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-0.835-1.755-1.954-3.18-3.356-4.278 c-1.405-1.096-3.159-1.645-5.265-1.645"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-3.336,0-6.297,1.361-8.885,4.08 c-2.589,2.721-4.761,6.143-6.515,10.267"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-1.756,4.126-3.073,8.601-3.949,13.426 c-0.878,4.827-1.316,9.302-1.316,13.426"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c0,2.457,0.197,4.783,0.592,6.976 c0.395,2.194,1.008,4.104,1.843,5.726"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c0.833,1.625,1.975,2.896,3.422,3.817 c1.448,0.921,3.225,1.382,5.331,1.382"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c3.159,0,6.01-1.271,8.556-3.817 c2.544-2.544,4.693-5.791,6.45-9.739"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c1.754-3.949,3.093-8.247,4.015-12.899 C133.927,256.991,134.387,252.56,134.387,248.348z"],HEAL_ATTR_APPEND);

// Grey C
$path = $svg->el("path",$grey);
$path->at(["d"=>"M215.862,235.58 c-1.23-2.018-2.721-3.598-4.475-4.738"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-1.757-1.14-4.038-1.712-6.845-1.712 c-3.511,0-6.669,1.273-9.477,3.817"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-2.809,2.546-5.178,5.748-7.107,9.608 c-1.931,3.862-3.402,8.141-4.41,12.834"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-1.01,4.695-1.514,9.192-1.514,13.491 c0,5.616,1.008,10.201,3.027,13.755"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c2.018,3.554,5.265,5.33,9.74,5.33 c2.982,0,5.483-0.679,7.502-2.04"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c2.018-1.359,3.729-2.784,5.134-4.277 l9.345,15.005"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-3.073,3.159-6.692,5.771-10.859,7.832 c-4.169,2.061-9.062,3.093-14.676,3.093"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-4.916,0-9.28-0.878-13.097-2.633 c-3.817-1.754-6.999-4.212-9.543-7.37"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-2.546-3.159-4.475-6.954-5.791-11.386 c-1.316-4.43-1.975-9.323-1.975-14.676"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c0-7.897,1.074-15.575,3.225-23.035 c2.149-7.457,5.199-14.061,9.148-19.809"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c3.949-5.747,8.665-10.354,14.15-13.821 c5.483-3.465,11.517-5.199,18.098-5.199"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c6.318,0,11.386,1.054,15.203,3.159 c3.817,2.106,6.822,4.695,9.016,7.766"],HEAL_ATTR_APPEND);
$path->at(["d"=>"L215.862,235.58z"],HEAL_ATTR_APPEND);

// Grey U
$path = $svg->el("path",$grey);
$path->at(["d"=>"M289.965,270.724 c-0.967,5.179-2.238,10.003-3.817,14.479"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-1.579,4.476-3.73,8.381-6.449,11.715 c-2.721,3.336-6.1,5.945-10.135,7.831"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-4.037,1.886-8.996,2.83-14.874,2.83 c-4.738,0-8.864-0.658-12.373-1.975"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-3.511-1.315-6.429-3.158-8.753-5.528 c-2.326-2.369-4.06-5.153-5.199-8.357"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-1.142-3.202-1.711-6.733-1.711-10.596 c0-1.58,0.066-3.246,0.198-5.002"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c0.131-1.754,0.372-3.554,0.724-5.396 l10.267-58.704"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h20.402 l-10.003,57.124"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c-0.263,1.493-0.483,2.962-0.658,4.41 c-0.177,1.447-0.263,2.786-0.263,4.015"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c0,3.072,0.636,5.616,1.909,7.634 c1.271,2.02,3.531,3.027,6.779,3.027"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c2.281,0,4.212-0.504,5.792-1.514 c1.579-1.008,2.896-2.369,3.949-4.08"],HEAL_ATTR_APPEND);
$path->at(["d"=>"c1.053-1.711,1.929-3.729,2.632-6.055 c0.701-2.324,1.271-4.805,1.711-7.438"],HEAL_ATTR_APPEND);
$path->at(["d"=>"l9.872-57.124 h20.27 L289.965,270.724z"],HEAL_ATTR_APPEND);

// Grey M
$path = $svg->el("path",$grey);
$path->at(["d"=>"M381.837,305.209"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-19.875 l11.978-64.759"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-0.395 l-27.378,64.759"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-14.479 l-4.212-64.759"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-0.395 l-10.662,64.759"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-18.295 l16.321-93.189"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h25.403 l4.475,60.941"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h0.527 l25.403-60.941"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h27.904z"],HEAL_ATTR_APPEND);

// Grey E
$path = $svg->el("path",$grey);
$path->at(["d"=>"M454.625,229.788"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-24.35 l-3.422,19.349"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h22.771 l-2.896,16.585"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-22.639 l-3.686,21.323"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h26.588 l-3.159,18.164"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-45.937 l16.189-93.189"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h43.567z"],HEAL_ATTR_APPEND);

// Grey N
$path = $svg->el("path",$grey);
$path->at(["d"=>"M516.883,305.209"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-21.719 l-12.24-58.046"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-0.396 l-9.477,58.046"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-18.164 l16.189-93.189"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h22.244 l11.715,58.836"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h0.526 l9.74-58.836"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h17.77z"],HEAL_ATTR_APPEND);

// Grey T
$path = $svg->el("path",$grey);
$path->at(["d"=>"M591.381,229.262"],HEAL_ATTR_APPEND);
$path->at(["d"=>"H574.27 l-13.294,75.947"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-20.007 l13.294-75.947"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h-17.11 l3.027-17.242"],HEAL_ATTR_APPEND);
$path->at(["d"=>"h54.229z"],HEAL_ATTR_APPEND);

echo $doc;