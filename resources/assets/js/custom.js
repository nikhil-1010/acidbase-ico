//AOS animation
jQuery(document).ready(function () {
    $('.loader').fadeOut("slow");
    $('.process-overview-slider').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: false,
      dots: true,
      arrows: false,
      infinite: false,
      pauseOnHover: true,
      responsive: [{
              breakpoint: 1200,
              settings: {
                  slidesToShow: 3
              }
          },
          {
              breakpoint: 991,
              settings: {
                  slidesToShow: 2
              }
          },
          {
              breakpoint: 560,
              settings: {
                  slidesToShow: 1
              }
          }
      ]
  });
});

// Tokonomics Pie Chart
var oilCanvas = document.getElementById("oilChart");

var oilData = {
    labels: [
        "Team",
        "Strategic Reserve",
        "Public Sale",
        "Community Rewards",
        "Beta/Testnet Incentives",
        "Advisors",
        "Grants",
        "Partnerships",
        "Marketing",
        "Liquidity Provision"
    ],
    datasets: [{
        data: [15, 15, 30, 10, 2.5, 5, 6, 6, 8, 2.5],
        backgroundColor: [
            "#f1548e",
            "#f97316",
            "#1251a0",
            "#22c55e",
            "#2271eb",
            "#702b91",
            "#f64a73",
            "#22c55e",
            "#2cdcb8",
            "#2b29ae"
        ]
    }]
};

var options = {
    elements: {
        arc: {
            borderWidth: 0,
        }
    },
    legend: {
        display: false,
    },
    tooltips: {
        callbacks: {
            label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
            title: () => null,
        }
    },
};

var pieChart = new Chart(oilCanvas, {
    type: 'pie',
    data: oilData,
    options: options
});


window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('cat|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('cat-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('cat-sidenav-toggled');
            localStorage.setItem('cat|sidebar-toggle', document.body.classList.contains('cat-sidenav-toggled'));
        });
    }
});


// Flip Clock

console.clear();

function CountdownTracker(label, value){

  var el = document.createElement('span');

  el.className = 'flip-clock__piece';
  el.innerHTML = '<b class="flip-clock__card card_panel"><b class="card__top"></b><b class="card__bottom"></b><b class="card__back"><b class="card__bottom"></b></b></b>' + 
    '<span class="flip-clock__slot">' + label + '</span>';

  this.el = el;

  var top = el.querySelector('.card__top'),
      bottom = el.querySelector('.card__bottom'),
      back = el.querySelector('.card__back'),
      backBottom = el.querySelector('.card__back .card__bottom');

  this.update = function(val){
    val = ( '0' + val ).slice(-2);
    if ( val !== this.currentValue ) {
      
      if ( this.currentValue >= 0 ) {
        back.setAttribute('data-value', this.currentValue);
        bottom.setAttribute('data-value', this.currentValue);
      }
      this.currentValue = val;
      top.innerText = this.currentValue;
      backBottom.setAttribute('data-value', this.currentValue);

      this.el.classList.remove('flip');
      void this.el.offsetWidth;
      this.el.classList.add('flip');
    }
  }
  
  this.update(value);
}

function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  return {
    'Total': t,
    'Days': Math.floor(t / (1000 * 60 * 60 * 24)),
    'Hours': Math.floor((t / (1000 * 60 * 60)) % 24),
    'Minutes': Math.floor((t / 1000 / 60) % 60),
    'Seconds': Math.floor((t / 1000) % 60)
  };
}

function Clock(countdown,callback) {
  countdown = countdown ? new Date(Date.parse(countdown)) : false;
  callback = callback || function(){};
  
  var updateFn = getTimeRemaining;

  this.el = document.createElement('div');
  this.el.className = 'flip-clock';

  var trackers = {},
      t = updateFn(countdown),
      key, timeinterval;

  for ( key in t ){
    if ( key === 'Total' ) { continue; }
    trackers[key] = new CountdownTracker(key, t[key]);
    this.el.appendChild(trackers[key].el);
  }

  var i = 0;
  function updateClock() {
    timeinterval = requestAnimationFrame(updateClock);
    
    // throttle so it's not constantly updating the time.
    if ( i++ % 10 ) { return; }
    
    var t = updateFn(countdown);
    if ( t.Total < 0 ) {
      cancelAnimationFrame(timeinterval);
      for ( key in trackers ){
        trackers[key].update( 0 );
      }
      callback();
      return;
    }

    for ( key in trackers ){
      trackers[key].update( t[key] );
    }
  }

  setTimeout(updateClock,500);
}

//var deadline = new Date(Date.parse(new Date()) + 12 * 24 * 60 * 60 * 1000);
var deadline = new Date(Date.parse(new Date('2025/12/25')));
var c = new Clock(deadline, function(){ /* Do something when countdouwn is complete */ });
var page_timer = document.getElementById('flip_timer');
page_timer.appendChild(c.el);

/*
var clock = new Clock();
document.body.appendChild(clock.el);
*/