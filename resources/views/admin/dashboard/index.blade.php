@extends('admin.layouts.app')
@section('content')
<style>
    .col-12.text-center img {
    background: #F5F5F5;
    box-shadow: 0px 0px 4px rgb(0 0 0 / 35%);
    border-radius: 10px;
    padding: 12px;
    margin-bottom: 17px;
}
</style>
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">Dashboard</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main</a></li>
            <li class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        </ol>
    </div>
    <div class="row">
        <!-- customar project  start -->
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-12 text-center">
                            <img src="http://www.manticoresoft.com/kt/saloo/assets/img/hrm.svg">

                        </div>
                        <div class="col-12 text-center">
                            <h2 class="m-b-0">HRM <br>Managment</h2>
                            <!--<h6 class="text-muted m-b-10">Dealer</h6>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-12 text-center">
                            <img src="http://www.manticoresoft.com/kt/saloo/assets/img/hrm.svg">

                        </div>
                        <div class="col-12 text-center">
                            <h2 class="m-b-0">HAULAGE <br>Managment</h2>
                            <!--<h6 class="text-muted m-b-10">Dealer</h6>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-12 text-center">
                            <img src="http://www.manticoresoft.com/kt/saloo/assets/img/hrm.svg">

                        </div>
                        <div class="col-12 text-center">
                            <h2 class="m-b-0">Purchase &<br>
Logistics</h2>
                            <!--<h6 class="text-muted m-b-10">Dealer</h6>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-12 text-center">
                            <img src="http://www.manticoresoft.com/kt/saloo/assets/img/hrm.svg">

                        </div>
                        <div class="col-12 text-center">
                            <h2 class="m-b-0">FLEET<br> Managment</h2>
                            <!--<h6 class="text-muted m-b-10">Dealer</h6>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center m-l-0">
                        <div class="col-12 text-center">
                            <img src="http://www.manticoresoft.com/kt/saloo/assets/img/hrm.svg">

                        </div>
                        <div class="col-12 text-center">
                            <h2 class="m-b-0">Admin &<br> Finance</h2>
                            <!--<h6 class="text-muted m-b-10">Dealer</h6>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('message.users')</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-primary users_date_range"><i class="fa fa-calendar fa-lg"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <br>
                                <div class="chart">
                                    <canvas id="usersChart" height="250" style="height: 250px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
   

    </div>
</div>
<!-- [ content ] End -->
<script>
var label = document.querySelector(".label");
var c = document.getElementById("c");
var ctx = c.getContext("2d");
var cw = c.width = 530;
var ch = c.height = 350;
var cx = cw / 2,
  cy = ch / 2;
var rad = Math.PI / 180;
var frames = 0;

ctx.lineWidth = 1;
ctx.strokeStyle = "#999";
ctx.fillStyle = "#ccc";
ctx.font = "14px monospace";

var grd = ctx.createLinearGradient(0, 0, 0, cy);
grd.addColorStop(0, "hsla(167,72%,60%,1)");
grd.addColorStop(1, "hsla(167,72%,60%,0)");

var oData = {
  "{{$line['5']['year']}}": {{$line['5']['count']}},
  "{{$line['4']['year']}}": {{$line['4']['count']}},
  "{{$line['3']['year']}}": {{$line['3']['count']}},
  "{{$line['2']['year']}}": {{$line['2']['count']}},
  "{{$line['1']['year']}}": {{$line['1']['count']}},
  "{{$line['0']['year']}}": {{$line['0']['count']}},
};

var valuesRy = [];
var propsRy = [];
for (var prop in oData) {

  valuesRy.push(oData[prop]);
  propsRy.push(prop);
}


var vData = 4;
var hData = valuesRy.length;
var offset = 50.5; //offset chart axis
var chartHeight = ch - 2 * offset;
var chartWidth = cw - 2 * offset;
var t = 1 / 7; // curvature : 0 = no curvature 
var speed = 2; // for the animation

var A = {
  x: offset,
  y: offset
}
var B = {
  x: offset,
  y: offset + chartHeight
}
var C = {
  x: offset + chartWidth,
  y: offset + chartHeight
}


// CHART AXIS -------------------------
ctx.beginPath();
ctx.moveTo(A.x, A.y);
ctx.lineTo(B.x, B.y);
ctx.lineTo(C.x, C.y);
ctx.stroke();

// vertical ( A - B )
var aStep = (chartHeight - 50) / (vData);

var Max = Math.ceil(arrayMax(valuesRy) / 10) * 10;
var Min = Math.floor(arrayMin(valuesRy) / 10) * 10;
var aStepValue = (Max - Min) / (vData);
console.log("aStepValue: " + aStepValue); //8 units
var verticalUnit = aStep / aStepValue;

var a = [];
ctx.textAlign = "right";
ctx.textBaseline = "middle";
for (var i = 0; i <= vData; i++) {

  if (i == 0) {
    a[i] = {
      x: A.x,
      y: A.y + 25,
      val: Max
    }
  } else {
    a[i] = {}
    a[i].x = a[i - 1].x;
    a[i].y = a[i - 1].y + aStep;
    a[i].val = a[i - 1].val - aStepValue;
  }
  drawCoords(a[i], 3, 0);
}

//horizontal ( B - C )
var b = [];
ctx.textAlign = "center";
ctx.textBaseline = "hanging";
var bStep = chartWidth / (hData + 1);

for (var i = 0; i < hData; i++) {
  if (i == 0) {
    b[i] = {
      x: B.x + bStep,
      y: B.y,
      val: propsRy[0]
    };
  } else {
    b[i] = {}
    b[i].x = b[i - 1].x + bStep;
    b[i].y = b[i - 1].y;
    b[i].val = propsRy[i]
  }
  drawCoords(b[i], 0, 3)
}

function drawCoords(o, offX, offY) {
  ctx.beginPath();
  ctx.moveTo(o.x - offX, o.y - offY);
  ctx.lineTo(o.x + offX, o.y + offY);
  ctx.stroke();

  ctx.fillText(o.val, o.x - 2 * offX, o.y + 2 * offY);
}
//----------------------------------------------------------

// DATA
var oDots = [];
var oFlat = [];
var i = 0;

for (var prop in oData) {
  oDots[i] = {}
  oFlat[i] = {}

  oDots[i].x = b[i].x;
  oFlat[i].x = b[i].x;

  oDots[i].y = b[i].y - oData[prop] * verticalUnit - 25;
  oFlat[i].y = b[i].y - 25;

  oDots[i].val = oData[b[i].val];
  
  i++
}



///// Animation Chart ///////////////////////////
//var speed = 3;
function animateChart() {
  requestId = window.requestAnimationFrame(animateChart);
  frames += speed; //console.log(frames)
  ctx.clearRect(60, 0, cw, ch - 60);
  
  for (var i = 0; i < oFlat.length; i++) {
    if (oFlat[i].y > oDots[i].y) {
      oFlat[i].y -= speed;
    }
  }
  drawCurve(oFlat);
  for (var i = 0; i < oFlat.length; i++) {
      ctx.fillText(oDots[i].val, oFlat[i].x, oFlat[i].y - 25);
      ctx.beginPath();
      ctx.arc(oFlat[i].x, oFlat[i].y, 3, 0, 2 * Math.PI);
      ctx.fill();
    }

  if (frames >= Max * verticalUnit) {
    window.cancelAnimationFrame(requestId);
    
  }
}
requestId = window.requestAnimationFrame(animateChart);

/////// EVENTS //////////////////////
c.addEventListener("mousemove", function(e) {
  label.innerHTML = "";
  label.style.display = "none";
  this.style.cursor = "default";

  var m = oMousePos(this, e);
  for (var i = 0; i < oDots.length; i++) {

    output(m, i);
  }

}, false);

function output(m, i) {
  ctx.beginPath();
  ctx.arc(oDots[i].x, oDots[i].y, 20, 0, 2 * Math.PI);
  if (ctx.isPointInPath(m.x, m.y)) {
    //console.log(i);
    label.style.display = "block";
    label.style.top = (m.y + 10) + "px";
    label.style.left = (m.x + 10) + "px";
    label.innerHTML = "<strong>" + propsRy[i] + "</strong>: " + valuesRy[i] + "%";
    c.style.cursor = "pointer";
  }
}

// CURVATURE
function controlPoints(p) {
  // given the points array p calculate the control points
  var pc = [];
  for (var i = 1; i < p.length - 1; i++) {
    var dx = p[i - 1].x - p[i + 1].x; // difference x
    var dy = p[i - 1].y - p[i + 1].y; // difference y
    // the first control point
    var x1 = p[i].x - dx * t;
    var y1 = p[i].y - dy * t;
    var o1 = {
      x: x1,
      y: y1
    };

    // the second control point
    var x2 = p[i].x + dx * t;
    var y2 = p[i].y + dy * t;
    var o2 = {
      x: x2,
      y: y2
    };

    // building the control points array
    pc[i] = [];
    pc[i].push(o1);
    pc[i].push(o2);
  }
  return pc;
}

function drawCurve(p) {

  var pc = controlPoints(p); // the control points array

  ctx.beginPath();
  //ctx.moveTo(p[0].x, B.y- 25);
  ctx.lineTo(p[0].x, p[0].y);
  // the first & the last curve are quadratic Bezier
  // because I'm using push(), pc[i][1] comes before pc[i][0]
  ctx.quadraticCurveTo(pc[1][1].x, pc[1][1].y, p[1].x, p[1].y);

  if (p.length > 2) {
    // central curves are cubic Bezier
    for (var i = 1; i < p.length - 2; i++) {
      ctx.bezierCurveTo(pc[i][0].x, pc[i][0].y, pc[i + 1][1].x, pc[i + 1][1].y, p[i + 1].x, p[i + 1].y);
    }
    // the first & the last curve are quadratic Bezier
    var n = p.length - 1;
    ctx.quadraticCurveTo(pc[n - 1][0].x, pc[n - 1][0].y, p[n].x, p[n].y);
  }

  //ctx.lineTo(p[p.length-1].x, B.y- 25);
  ctx.stroke();
  ctx.save();
  ctx.fillStyle = grd;
  ctx.fill();
  ctx.restore();
}

function arrayMax(array) {
  return Math.max.apply(Math, array);
};

function arrayMin(array) {
  return Math.min.apply(Math, array);
};

function oMousePos(canvas, evt) {
  var ClientRect = canvas.getBoundingClientRect();
  return { //objeto
    x: Math.round(evt.clientX - ClientRect.left),
    y: Math.round(evt.clientY - ClientRect.top)
  }
}
</script>
@endsection