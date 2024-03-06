window.addEventListener('load', function () {
  const circleBar = document.querySelectorAll('.circle-bar');
  const lineBar = document.querySelectorAll('.line-bar');

  circleBar.forEach(circleItem => {
    const circleProgress = Number(circleItem.dataset.progress) / 100;
    const circleId = `#${circleItem.id}`;

    // progressbar.js@1.0.0 version is used
    // Docs: http://progressbarjs.readthedocs.org/en/1.0.0/

    var bar = new ProgressBar.Circle(circleId, {
      color: '#aa8453',
      // This has to be the same size as the maximum width to
      // prevent clipping
      strokeWidth: 4,
      trailWidth: 1,
      easing: 'easeInOut',
      duration: 1400,
      text: {
        autoStyleContainer: false
      },
      from: { color: '#aa8453', width: 2 },
      to: { color: '#aa8453', width: 2 },
      // Set default step function for all animate calls
      step: function (state, circle) {
        circle.path.setAttribute('stroke', state.color);
        circle.path.setAttribute('stroke-width', state.width);

        var value = Math.round(circle.value() * 100);
        if (value === 0) {
          circle.setText('');
        } else {
          circle.setText(value);
        }

      }
    });
    bar.text.style.fontSize = '1.3rem';

    bar.animate(circleProgress);  // Number from 0.0 to 1.0

  });

  lineBar.forEach(lineItem => {
    const lineProgress = Number(lineItem.dataset.progress) / 100;
    const lineId = `#${lineItem.id}`;

    var bar = new ProgressBar.Line(lineId, {
      strokeWidth: 1,
      easing: 'easeInOut',
      duration: 1400,
      color: '#aa8453',
      trailColor: '#eee',
      trailWidth: 1,
      svgStyle: { width: '100%', height: '100%' },
      text: {
        style: {
          // Text color.
          // Default: same as stroke color (options.color)
          color: 'black',
          position: 'absolute',
          right: '0',
          top: '-25px',
          padding: 0,
          margin: 0,
          transform: null
        },
        autoStyleContainer: false
      },
      from: { color: '#aa8453', width: 2 },
      to: { color: '#aa8453', width: 2 },
      step: (state, bar) => {
        bar.setText(Math.round(bar.value() * 100) + ' %');
      }
    });

    bar.animate(lineProgress);  // Number from 0.0 to 1.0
  });
});



