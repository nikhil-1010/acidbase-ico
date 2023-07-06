// Slick Slider
$(document).ready(function () {
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
	}).on('setPosition', function (event, slick) {
		slick.$slides.css('height', slick.$slideTrack.height() + 'px');
	});
});

//back to top js
$(document).ready(function () {
	$(window).scroll(function () {
		if ($(this).scrollTop() > 700) {
			$('.back-to-top').fadeIn();
		} else {
			$('.back-to-top').fadeOut();
		}
	});
	// scroll body to 0px on click
	$('.back-to-top').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		return false;
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
			"rgba(241, 84, 142, 0.25)",
			"rgba(249, 115, 22, 0.25)",
			"rgba(18, 81, 160, 0.25)",
			"rgba(34, 197, 94, 0.25)",
			"rgba(34, 113, 235, 0.25)",
			"rgba(112, 43, 145, 0.25)",
			"rgba(246, 74, 115, 0.25)",
			"rgba(34, 197, 94, 0.25)",
			"rgba(44, 220, 184, 0.25)",
			"rgba(43, 41, 174, 0.25)"
		],
		borderColor: [
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
		],
		borderWidth: 2,
		hoverBorderWidth: 7,
		hoverShadowColor: 'rgba(0, 0, 0, 0.5)',
		hoverShadowOffsetX: 10,
		hoverShadowOffsetY: 5,
		hoverBackgroundColor:  [
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
		],
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
	plugins: {
		tooltips: {
			callbacks: {
				label: tooltipItem => `${console.log(tooltipItem.yLabel)} : ${tooltipItem.xLabel}`,
				title: () => null,
			}
		},
	},
};

var pieChart = new Chart(oilCanvas, {
	type: 'pie',
	data: oilData,
	options: options
});


// Flip Clock

console.clear();

function CountdownTracker(label, value) {

	var el = document.createElement('span');

	el.className = 'flip-clock__piece';
	el.innerHTML = '<b class="flip-clock__card card_panel"><b class="card__top"></b><b class="card__bottom"></b><b class="card__back"><b class="card__bottom"></b></b></b>' +
		'<span class="flip-clock__slot">' + label + '</span>';

	this.el = el;

	var top = el.querySelector('.card__top'),
		bottom = el.querySelector('.card__bottom'),
		back = el.querySelector('.card__back'),
		backBottom = el.querySelector('.card__back .card__bottom');

	this.update = function (val) {
		val = ('0' + val).slice(-2);
		if (val !== this.currentValue) {

			if (this.currentValue >= 0) {
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

//var deadline = new Date(Date.parse(new Date()) + 12 * 24 * 60 * 60 * 1000);
var deadline = new Date(Date.parse(new Date('2025/12/25')));
var c = new Clock(deadline, function () { /* Do something when countdouwn is complete */ });
var page_timer = document.getElementById('flip_timer');
page_timer.appendChild(c.el);
