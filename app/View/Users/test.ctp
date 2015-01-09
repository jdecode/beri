<?php ?>
<script type="text/javascript">
	$(document).ready(function () {
		var theme = getTheme(),
		majorTicks = { size: '10%', interval: 10 },
		minorTicks = { size: '5%', interval: 2.5, style: { 'stroke-width': 1, stroke: '#aaaaaa'} },
		labels = { position: 'outside', interval: 20 };
		$('#gauge').jqxLinearGauge({
			orientation: 'horizontal',
			labels: labels,
			ticksMajor: majorTicks,
			ticksMinor: minorTicks,
			max: 100,
			min: 0,
			value: 20,
			pointer: { size: '6%' },
			colorScheme: 'scheme05',
			height	:	'100px',
			width	:	'300px'
		});
		$('#gauge').jqxLinearGauge('value', 0);
		$('#slider').jqxSlider({ min: 0, max: 100, mode: 'fixed', ticksFrequency: 20, width: 200, value: 20, theme: theme, showButtons: true });

		$('#slider').mousedown(function () {
			$('#gauge').jqxLinearGauge('value', $('#slider').jqxSlider('value'));
		});
		$('#slider').bind('slideEnd', function (e) {
			$('#gauge').jqxLinearGauge('value', e.args.value);
		});
		$('#slider').bind('mousewheel', function () {
			$('#gauge').jqxLinearGauge('value', $('#slider').jqxSlider('value'));
		});
		$('#gauge').jqxLinearGauge('value', 20);
	});
</script>

<div class="demo-gauge" style="position: relative; height: 380px;">
	<div id='gauge' style="position: absolute; top: 0px; left: 0px;">
	</div>
	<br />
	<br />
	<div id='slider' style="position: absolute; top: 250px; left: 93px;">
	</div>
</div>


