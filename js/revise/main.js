var Word = function (word, answer, wrongAnswer) {
	this.word = word;
	this.variants = [answer, wrongAnswer];
	this.answer = answer;
};

var words = [
	new Word('month', 'месяц', 'дом'),
	{word: 'test', variants: ['кошка', 'тест'], answer: 'тест'},
	{word: 'apple', variants: ['яблоко', 'картина'], answer: 'яблоко'},
	{word: 'holidays', variants: ['праздники', 'рутина'], answer: 'праздники'},
	{word: 'week', variants: ['предмет', 'неделя'], answer: 'неделя'},
	{word: 'dog', variants: ['кошка', 'собака'], answer: 'собака'},
	{word: 'tree', variants: ['дерево', 'корова'], answer: 'дерево'},
	{word: 'past', variants: ['будущее', 'прошлое'], answer: 'прошлое'}
];

var app = {
	words: [],
	config: {},
	currentWordId: 0,
	progressBar: null,
	userRightOrWrong: false,

	load: function(words){
		this.words = words;
		this.progressBar = new ProgressBar.Circle('#progress', {
		    color: '#B6B9D1',
		    easing: 'linear',
		    strokeWidth: 6,
		    trailWidth: 1,
		    duration:3000,
		    text: {
	        value: '0'
		    },
		    step: function(state, bar) {
		        bar.setText((bar.value() * 100).toFixed(0));
		    }
		});

		this.init();
		setTimeout(this.showResult(), 0);

	},

	init: function(){
		this.config = this.words[this.currentWordId];
		this.showQuestion();
	},

	nextWord: function(){
		this.setStateClear();
		this.currentWordId++;
		this.init();
	},

	showQuestion: function() {
		var wordElement = document.getElementById('word');
		wordElement.innerHTML = this.config.word;

		var leftVariant = document.getElementById('variant1');
		leftVariant.innerHTML = this.config.variants[0];

		var rightVariant = document.getElementById('variant2');
		rightVariant.innerHTML = this.config.variants[1];

		this.startTimer();
	},

	checkAnswer: function(elementId){
		var answerElement = document.getElementById(elementId);
		var userAnswer = answerElement.innerHTML;

		this.hideProgress();
		document.getElementById('imgOkSign').setAttribute('style', 'display: block;');

		if(userAnswer == this.config.answer)
		{
			this.setStateOk();
			//suserRightOrWrong = true;
		}
		else
		{
			this.setStateWrong();
		}

		setTimeout(this.nextWord.bind(this), 500);
	},

	hideProgress: function(){
		document.getElementById('progress').setAttribute('style', 'display: hidden;');
	},

	startTimer: function(){
		document.getElementById('progress').setAttribute('style', 'display: block;');
		document.getElementById('imgOkSign').setAttribute('style', 'display: hidden;');
		this.progressBar.set(0);
		this.progressBar.animate(1, {}, function(){
			this.getCorrectElement();
			this.setStateOk();
		}.bind(this));
	},

	getCorrectElement: function(){
		var leftElement = document.getElementById('variant1');
		var leftAnswer = leftElement.innerHTML;
		var rightElement = document.getElementById('variant2');
		var rightAnswer = rightElement.innerHTML;

		if(leftAnswer == this.config.answer)
		{
			document.getElementById('variant1').setAttribute('style', 'background-color: #D2EEC8;');
		}
		else if(rightAnswer == this.config.answer)
		{
			document.getElementById('variant2').setAttribute('style', 'background-color: #D2EEC8;');
		}

	},

	cleanAnswerStyles: function(){
		var leftElement = document.getElementById('variant1');
		var leftAnswer = leftElement.innerHTML;
		var rightElement = document.getElementById('variant2');
		var rightAnswer = rightElement.innerHTML;

		document.getElementById('variant1').setAttribute('style', '');
		document.getElementById('variant2').setAttribute('style', '');

	},

	showResult: function(){
		if(!this.currentWordId)
		{
			var wordElement = [];
			var leftVariant = [];
			var rightVariant = [];
			for(var i = 0; i < this.config.word.length; i++)
			{
				wordElement[i] = document.getElementById('word');
				wordElement.innerHTML = this.config.word;

				leftVariant[i] = document.getElementById('variant1');
				leftVariant.innerHTML = this.config.variants[0];

				rightVariant[i] = document.getElementById('variant2');
				rightVariant.innerHTML = this.config.variants[1];
			}
		}
	},

	setStateOk: function(){
		var state = document.getElementById('imgOkSign');
		state.innerHTML = '<img src="./img/ok.png"/>';
	},

	setStateWrong: function(){
		var state = document.getElementById('imgOkSign');
		state.innerHTML = '<img src="./img/wrong.png"/>';
	},

	setStateClear: function(){
		var state = document.getElementById('imgOkSign');
		state.innerHTML = '';
	}
};

(function() {
	app.load(words);

})();

var variant1 = $('#variant1');
var variant2 = $('#variant2');

var variants = $('#translationVariants');

variants.click(function(event) {
	var target = event.target;
	
	if(target.id == 'variant1' || target.id == 'variant2')
	{
		app.checkAnswer(target.id);
	}
})










/*


var i = 0;
var helloNastia = function() {
	alert('Hello Nastia!'+ i);
	i++;

	if(i == 5)
	{
		clearInterval(id);
	}

};
var id = setInterval(helloNastia, 3000);
*/
