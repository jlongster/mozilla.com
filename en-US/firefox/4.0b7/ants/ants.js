var hud, canvas, buffer;

var full = 30;

var have_food = false;
var spider;
var total_kos = 0;
var anger_kos = 100;

function Spider()
{
  this.v = 6;
  this.x = 20;
  this.y = side - 20;

  this.tx = this.x;
  this.ty = this.y;

  this.a = -0.5*Math.PI;
  this.vx = 0;
  this.vy = 0;
  this.steps = 1;

  this.hp = 100;
}

Spider.prototype.Draw = function(cx)
{
  cx.fillRect(this.x-8, this.y-8, 16, 16);
  // middle legs
  cx.fillRect(this.x-16, this.y-3, 32, 2);
  cx.fillRect(this.x-16, this.y+3, 32, 2);
  // back legs
  cx.fillRect(this.x-3, this.y-16, 2, 32);
  cx.fillRect(this.x+3, this.y-16, 2, 32);
  return;

  //cx.drawImage(spiderImg, this.x-10, this.y-10);

  cx.save();
  cx.translate(this.x-10, this.y-10);
  cx.rotate(this.a);
  cx.drawImage(spiderImg, 0, 0);
  cx.restore();
}

Spider.prototype.Control = function()
{
  var kos = 0;

  if (this.hp) {
    var best_dist = 1e9;
    var best;
    for (var i = 0; i < N; ++i) {
      var ant = ants[i];
      if (ant.ko)
	continue;
      var dx = this.x - ant.x;
      var dy = this.y - ant.y;
      var dist = dx*dx + dy*dy;
      if (dist < best_dist) {
	best_dist = dist;
	best = ant;
      }

      if (dist < 100) {
	if (kos < 5) {
	  ++kos;
	  ++total_kos;
	  ant.ko = 200;
	} else {
	  if (this.hp) --this.hp;
	}
      }
      ant.near_spider = (dist < 400000);
    }
    if (best == undefined) {
      this.tx = this.x;
      this.ty = this.y;
      this.vx = 0;
      this.vy = 0;
      this.steps = 1;
      return;
    } else {
      this.tx = best.x;
      this.ty = best.y;
    }
  } else {
    if (this.x < 0 || this.y > side) {
      ToggleSpider();
      return;
    }
    this.tx = -20;
    this.ty = side + 20;  
  }

  var dx = this.tx - this.x;
  var dy = this.ty - this.y;
  var dist = Math.sqrt(dx*dx + dy*dy);
  var q = this.v * 0.01 / dist;
  this.vx = dx * q;
  this.vy = dy * q;
  //this.a = Math.atan2(-this.vy, this.vx);
  if (dist > this.v) {
    this.steps = 100;
  } else {
    this.steps = Math.floor(dist / this.v * 100);
  }
}

Spider.prototype.Move = function(dq)
{
  if (this.steps == 0)
    return;

  this.x += this.vx;
  this.y += this.vy;
  --this.steps;
}

function Ant() {
  this.v = 2;
  this.x = side - 20;
  this.y = side - 20;
  this.a = Math.PI * 0.75;

  this.at_food = false;
  this.food = 0;
  this.full = false;

  // Which front feet are blocked by an obstacle.
  this.blocked_left = false;
  this.blocked_right = false;

  this.ko = 0;
  this.near_spider = false;
}

Ant.prototype.Draw = function(cx) {
  var dx = Math.cos(this.a) * 4;
  var dy = -Math.sin(this.a) * 4;
  cx.fillRect(this.x + dx - 1.5, this.y + dy - 1.5, 3, 3);

  cx.save();
  if (this.ko)
    cx.fillStyle = '#777777';
  else if (total_kos >= anger_kos)
    cx.fillStyle = '#882222'
  else if (this.food >= full)
    cx.fillStyle = '#22ee22';
  else if (this.food > 0)
    cx.fillStyle = '#226622';
  cx.fillRect(this.x - 2, this.y - 2, 4, 4);
  cx.restore();

/*
  if (this.blocked_left)
    cx.fillText('L', 4, 50);
  else if (this.blocked_right)
    cx.fillText('R', 4, 50);
*/
}

Ant.prototype.Control = function() {
  if (this.ko) {
    --this.ko;
    return;
  }

  this.at_food = have_food && this.x > 100 && this.x < 180 && this.y > 20 && this.y < 80;
  this.at_home = this.food > 0 && this.x > side - 40 && this.y > side - 40;

  if (this.blocked_left) {
    this.a -= Math.PI / 24;
    //this.blocked_left = false;
  }
  else if (this.blocked_right) {
    this.a += Math.PI / 24;
    //this.blocked_right = false;
  } else if (total_kos >= anger_kos) {
    var to_enemy = Math.atan2(-(spider.y - this.y), spider.y - this.x);
    if (to_enemy < 0)
      to_enemy += 2 * Math.PI;
    var da = to_enemy - this.a;
    if (Math.abs(da) > Math.PI / 24) {
     if (0 < da && da < Math.PI)
       this.a += Math.PI / 48;
     else
       this.a -= Math.PI / 48;
    }
  } else if (!this.at_home && !this.at_food && this.food > 0) {
    var to_home = Math.atan2(-(side - this.y), side - this.x);
    if (to_home < 0)
      to_home += 2 * Math.PI;
    var da = to_home - this.a;
    if (Math.abs(da) > Math.PI / 24) {
     if (0 < da && da < Math.PI)
       this.a += Math.PI / 48;
     else
       this.a -= Math.PI / 48;
    }
  }

  this.a += (Math.random() * 10 - 5) / 360 * 2 * Math.PI;

  if (this.a < 0)
    this.a += 2 * Math.PI;
  else if (this.a > 2 * Math.PI)
    this.a -= 2 * Math.PI;
}

var junk = 0;

var brickLeft = 80;
var brickTop = 100;

var brickWidth = 167
var brickHeight = 250;
var brickRight = brickLeft + brickWidth;
var brickBottom = brickTop + brickHeight;


Ant.prototype.Move = function(dq) {
  if (this.ko)
    return;

  if (total_kos < anger_kos) {
    if (this.at_food && this.food < full) {
      this.food += dq * 1;
      if (this.food >= full) {
	this.food = full;
      }

      return;
    }

    if (this.at_home && this.food > 0) {
      var food = this.food - dq * 2;
      if (food < 0)
	food = 0;
      hive_food += food;
      this.food = food;
      return;
    }

    if (!this.at_home && !this.at_food && this.food > 0) {
      var i = Math.floor(this.x / phpx);
      var j = Math.floor(this.y / phpx);
      var c = ph[j * phside + i];
      c += dq * 0.01
      if (c > 1) c = 1;
      ph[j * phside + i] = c;
    }
  }

  this.blocked_left = false;
  this.blocked_right = false;

  var vs = this.v * dq;
  if (total_kos >= anger_kos)
    vs *= 2;
  var dx = Math.cos(this.a) * vs;
  var dy = -Math.sin(this.a) * vs;
  var x = this.x + dx;
  var y = this.y + dy;

  if (x < 20) {
    if (this.a < Math.PI)
      this.blocked_left = true;
    else
      this.blocked_right = true;
    x = 20;
  } else if (x >= side - 20) {
    if (this.a < Math.PI)
      this.blocked_right = true;
    else
      this.blocked_left = true;
    x = side - 20;
  }
  if (y < 20) {
    if (this.a < Math.PI * 0.5)
      this.blocked_left = true;
    else
      this.blocked_right = true;
    y = 20;
  } else if (y >= side - 20) {
    if (this.a < Math.PI * 1.5)
      this.blocked_left = true;
    else
      this.blocked_right = true;
    y = side - 20;
  }

  if (x > brickLeft && x < brickRight && y > brickTop && y < brickBottom) {
    if (x > brickRight - 20) {
      if (this.a < Math.PI)
        this.blocked_left = true;
      else
        this.blocked_right = true;
    } else if (x < brickLeft + 20) {
      if (this.a < Math.PI)
	this.blocked_right = true;
      else
	this.blocked_left = true;
      x = side - 20;
    } else if (y > brickBottom - 20) {
      if (this.a < Math.PI * 0.5)
	this.blocked_left = true;
      else
	this.blocked_right = true;
    } else if (y < brickTop + 20) {
      if (this.a < Math.PI * 1.5)
	this.blocked_left = true;
      else
	this.blocked_right = true;
    }

    x = this.x;
    y = this.y;
  }

  this.x = x;
  this.y = y;

  //eval("");
}

var N = 500;
try {
  var s = window.location.search;
  if (s.length != 0) {
    N = parseInt(s.substr(1));
    anger_kos = Math.floor(N / 5);
  }
} catch(e) {
}

var ants = [ ];
for (var i = 0; i < N; ++i)
  ants.push(new Ant());

var hive_food = 0;

var ph = [];
var phside = 10;
var phpx = side / phside;
for (var i = 0; i < phside * phside; ++i)
  ph[i] = .5;

function Move() {
  if (spider != undefined) {
    spider.Control();
  }

  for (var i = 0; i < N; ++i)
    ants[i].Control();

  for (var i = 0; i < N; ++i) {
      for (var j = 0; j < 100; ++j) {
        ants[i].Move(.01);
        if (spider) spider.Move(.01);
      }
  }

  for (var i = 0; i < phside; ++i) {
    for (var j = 0; j < phside; ++j) {
      ph[j * phside + i] *= 0.95
    }
  }
}

function DrawSpeeds()
{
  var cx = hud.getContext('2d');
  cx.textAlign = 'center';
  cx.textBaseline = 'top';
  cx.clearRect(0, 0, hside, side);

  //cx.fillText('food: ' + hive_food, 4, 74);

  // Compute output numbers
  var dts_all = 0, dts_cmp = 0;
  for (var i = 0; i < frame_index_max; ++i) {
    dts_all += dt_all[i];
    dts_cmp += dt_cmp[i];
  }
  dts_all *= 0.00001;
  dts_cmp *= 0.00001;

  var y = 10;

  // Compute fps
  if (frame_index >= frame_index_max) {
    cx.fillStyle = 'red';
    cx.font = '80px sans-serif';
    cx.fillText(Math.floor(1 / dts_cmp), hside / 2, y); y += 75
  }
  cx.font = '24px sans-serif';
  cx.fillText('JS speed', hside / 2, y);

  y += 74;

  // Graphical fps
  if (frame_index >= frame_index_max) {
    cx.fillStyle = 'lightblue';
    cx.font = '80px sans-serif';
    cx.fillText(Math.floor(1 / dts_all), hside / 2, y); y += 75
  }
  cx.font = '24px sans-serif';
  cx.fillText('fps', hside / 2, y);
}

function Draw() {
  var cx = buffer.getContext('2d');

/*
  for (var i = 0; i < 10; ++i) {
    for (var j = 0; j < 10; ++j) {
      var color;
      var c = ph[j * phside + i]
      var ci = 255 - Math.floor(c * 128);
      var cs = ci.toString(16);
      if (ci < 16)
        cs = '0' + cs;
      color = '#' + cs + 'ff' + cs;
      cx.fillStyle = color;
      cx.fillRect(i * phpx, j * phpx, phpx, phpx);
      cx.fillStyle = '#ffffff';
      cx.fillText(Math.floor(c*100), i * phpx + phpx/2, j * phpx + phpx /2 );
    }
  }

*/

  // Earth background
  cx.drawImage(earthImg, 0, 0);

  // Brick
  cx.drawImage(brickImg, brickLeft, brickTop);

  // Food
  if (have_food) {
    cx.drawImage(pizzaImg, 100, 20);
  }

  // Ants
  cx.fillStyle = '#000000';
  for (var i = 0; i < N; ++i)
    ants[i].Draw(cx);
  if (spider)
    spider.Draw(cx);

  // Spider health bar
  if (spider && spider.hp) {
    var h = side * 0.05;
    var x0 = side * 0.1;
    var w0 = side * 0.008 * spider.hp;
    var x1 = x0 + w0;
    var w1 = side * 0.8 - x1;

    cx.fillStyle = '#ee2200';
    cx.fillRect(x0, h, w0, 20);
    //cx.fillStyle = '#ee2200';
    //cx.fillRect(x1, h, w1, 20);

    cx.strokeStyle = '#ffffff';
    cx.strokeRect(x0, side * .05, side * .8, 20);

    cx.fillStyle = '#ffffff'
    cx.font = '12px sans-serif';
    cx.textBaseline = 'middle'
    cx.fillText('Spider', side * .1 + 8, side * .05 + 10);
  }

  var id = cx.getImageData(0, 0, side, side);

  var cx2 = canvas.getContext('2d');
  cx2.putImageData(id, 0, 0, 0, 0, side, side);

  DrawSpeeds();
}

var t_last;
var frame_index = 0;
var frame_index_max = 30;

var dt_all = [];
var dt_cmp = [];

for (var i = 0; i < frame_index_max; ++i) {
  dt_all[i] = 0;
  dt_cmp[i] = 0;
}

function TimerCallback() {
  if (!running) {
    t_last = undefined;
    return;
  }

  var t0 = new Date;
  if (t_last != undefined)
    dt_all[frame_index % frame_index_max] = t0 - t_last;
  Move();
  var t2 = new Date;
  if (t_last != undefined) {
    dt_cmp[frame_index % frame_index_max] = t2 - t0;
    ++frame_index;
  }
  Draw();
  t_last = t0;
  window.setTimeout(TimerCallback, 0);
}

var initialized = false;

var earthImg;
var brickImg;
var pizzaImg;
var spiderImg;

var imgs;
var loadedCount;

function OnImageLoad()
{
    ++loadedCount;

    var cx = canvas.getContext('2d');
    cx.fillStyle = '#000000'
    cx.fillRect(0, 0, side, side);
    cx.fillStyle = '#ffffff';
    cx.fillText('Loading images: ' + loadedCount + '/' + imgs.length,
	        20, side - 20);
}

function Init()
{
  if (initialized)
    return;

  hud = document.getElementById('hud');

  buffer = document.createElement('canvas');
  buffer.setAttribute('width', side);
  buffer.setAttribute('height', side);
  buffer.setAttribute('class', 'mapping');

  document.getElementById('holder').appendChild(buffer);

  canvas = document.getElementById('canvas');

  brickImg = document.createElement('img');
  brickImg.setAttribute('src', 'SmallBrickGray.png');
  document.getElementById('holder').appendChild(brickImg);

  earthImg = document.createElement('img');
  earthImg.setAttribute('src', 'SmallEarthWithAnthill.png');
  document.getElementById('holder').appendChild(earthImg);

  pizzaImg = document.createElement('img');
  pizzaImg.setAttribute('src', 'SmallPizza.png');
  document.getElementById('holder').appendChild(pizzaImg);

  spiderImg = document.createElement('img');
  spiderImg.setAttribute('src', 'SmallSpider.png');
  document.getElementById('holder').appendChild(spiderImg);

  loadedCount = 0;
  imgs = [ brickImg, earthImg, pizzaImg, spiderImg ];
  for (var i = 0; i < imgs.length; ++i) {
    imgs[i].onload = OnImageLoad;
  }

  initialized = true;
}

var running = false;

function ToggleRun() {
  if (!running) {
    Init();
    running = true;
    document.getElementById('start').innerHTML = 'Stop';
    window.setTimeout(TimerCallback, 0);
  } else {
    running = false;
    document.getElementById('start').innerHTML = 'Start';
  }
}

function ToggleFood() {
  if (!have_food) {
    have_food = true;
    document.getElementById('food').innerHTML = 'Grab Food';
  } else {
    have_food = false;
    document.getElementById('food').innerHTML = 'Drop Food';
  }
}

function ToggleSpider() {
  if (spider == undefined) {
    document.getElementById('spider').innerHTML = 'Remove Spider';
    spider = new Spider();
  } else {
    document.getElementById('spider').innerHTML = 'Send Spider';
    spider = undefined;
  }
  total_kos = 0;
}
