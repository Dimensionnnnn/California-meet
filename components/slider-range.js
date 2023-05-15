const [rangeSliderFrom, rangeSliderTo] = ['user-input-from', 'user-input-to'].map(id => document.getElementById(id));

const rangeSlideFrom = value => {
    document.getElementById('rangeValueF').innerHTML = value;
    rangeSliderTo.min = parseInt(value);
};

const rangeSlideTo = value => {
    document.getElementById('rangeValueT').innerHTML = value;
    rangeSliderFrom.max = parseInt(value);
};