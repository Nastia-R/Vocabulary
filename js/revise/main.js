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
	userAnswers: {right:[], wrong:[], timeOut:[]},
	progressBar: null,
	userRightOrWrong: false,
	timeoutId: 0,
	timerOut: false,

	load: function(words){
		this.words = words;
		this.initProgressBar();
		this.initClickHandlers();
		this.init();
		setTimeout(this.showResult(), 0);
	},

	initProgressBar: function(){
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
	},

	initClickHandlers: function(){
		var variants = $('#translationVariants');
		variants.click(this.onVariantClick.bind(this));
	},

	init: function(){
		this.config = this.words[this.currentWordId];
		this.showQuestion();
	},

	onVariantClick: function(event){
		if(this.isVariantsDisabled())
		{
			return;
		}
		var target = event.target;
		if(this.timerOut)
		{
			if($(target).attr('class') != 'disabled')
			{
				this.onTimeOut();
			}
		}
		else if((target.id == 'variant1' || target.id == 'variant2'))
		{	
			this.checkAnswer(target.id);
		}
	},

	onTimeOut: function(){
		clearTimeout(this.timeoutId);
		this.nextWordOrShowResult(0);
	},

	nextWordOrShowResult: function(timeOut){
		if(!this.isLastWord())
		{
			this.timeoutId = setTimeout(this.nextWord.bind(this), timeOut);
		}
		else
		{
			this.showResultTable();
		}
	},

	nextWord: function(){
		this.setStateClear();
		this.enableVariants();

		if(!this.isLastWord())
		{
			this.currentWordId++;
			this.init();
		}
		else
		{
			alert('There is no next word!');
		}
	},

	showQuestion: function() {
		$('#word').html(this.config.word);
		$('#variant1').html(this.config.variants[0]);
		$('#variant2').html(this.config.variants[1]);

		this.cleanAnswerStyles();
		this.startTimer();
		this.timerOut = false;
	},

	checkAnswer: function(elementId){
		clearTimeout(this.timeoutId);

		var answerElement = $('#'+elementId);
		var userAnswer = answerElement.html();

		this.hideProgress();
		document.getElementById('imgOkSign').setAttribute('style', 'display: block;');

		if(userAnswer == this.config.answer)
		{
			this.userAnswers.right.push(this.config.word); 
			console.log('rightArray: ' + this.userAnswers.right);
			this.setStateOk();
			this.getCorrectElement(answerElement, true);
		}
		else if(userAnswer != this.config.answer && userAnswer != undefined)
		{	
			this.userAnswers.wrong.push(this.config.word);
			console.log('wrongArray: ' + this.userAnswers.wrong);
			this.setStateWrong();
			this.getCorrectElement(answerElement, false);
		}

		this.disableVariants();
		this.nextWordOrShowResult(400);
	},

	disableVariants: function(){
		this.variantsDisabled = true;
	},

	enableVariants: function(){
		this.variantsDisabled = false;
	},

	isVariantsDisabled: function(){
		return this.variantsDisabled;
	},

	showResultTable: function(){
		$('.table-fill').html('');
		var result = this.calculateAnswersNum();
		var bars = [];
		bars.push({id:'#barRemember', number: result.right.length});
		bars.push({id:'#barMistakes', number: result.wrong.length});
		bars.push({id:'#barTimeOut', number: result.timeOut.length});

		for(var i = 0; i < bars.length; i++)
		{
			if(bars[i].number == 0)
			{
				$(bars[i].id).css({'display': 'none'});
			}
		}

		$('.table-fill').append($('#resultTable'));
		var altogetherWords = this.words.length;
		startDiagram(altogetherWords);
		$('#resultTable').fadeIn(1000);
	},

	isLastWord: function(){
		return (this.currentWordId >= this.words.length - 1)
	},

	hideProgress: function(){
		document.getElementById('progress').setAttribute('style', 'display: none;');
	},

	startTimer: function(){
		document.getElementById('progress').setAttribute('style', 'display: block;');
		this.progressBar.set(0);
		this.progressBar.animate(1, {}, function(){
			this.hideProgress();
			document.getElementById('imgOkSign').setAttribute('style', 'display: block;');
			this.setStateWrong();
			this.setDisabledClass();
			this.timerOut = true;
		}.bind(this));
	},

	getCorrectElement: function(element, rightOrWrong){

		if(rightOrWrong)
		{
			element.addClass('rightVariant');
		}
		else
		{
			element.addClass('wrongVariant');
		}

	},

	setDisabledClass: function(){
		if($('#variant1').html() == this.config.answer)
		{
			$('#variant2').addClass('disabled');
		}
		else if($('#variant2').html() == this.config.answer)
		{
			$('#variant1').addClass('disabled');
		}

		this.userAnswers.timeOut.push(this.config.word);
		console.log('timeOutArray: ' + this.userAnswers.timeOut);
	},

	cleanAnswerStyles: function(){
		$('#variant1').removeAttr('class');
		$('#variant2').removeAttr('class');
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

	calculateAnswersNum: function(){
		return {'right': this.userAnswers.right, 'wrong': this.userAnswers.wrong, 'timeOut' : this.userAnswers.timeOut};
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