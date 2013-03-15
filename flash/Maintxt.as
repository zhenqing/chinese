package  {
	import flash.display.MovieClip;
	import flash.display.Sprite;
	import flash.filters.*;
	import flash.events.*;
	
	/*
	import org.libspark.betweenas3.BetweenAS3;
	import org.libspark.betweenas3.easing.Quad;
	import org.libspark.betweenas3.events.TweenEvent;
	import org.libspark.betweenas3.tweens.ITween;
	*/
	import caurina.transitions.Tweener;
	import caurina.transitions.properties.FilterShortcuts;
	
	//image1 Part
	
	public class Maintxt extends Sprite {
		
		private var _matrixArray:Array = [ 0, 0, 0, 0, 1, 0, 0, 0, 0];
		private var _convFilter:ConvolutionFilter = new ConvolutionFilter(3, 3, _matrixArray);
		private var _number = 1;
		
		// IDENTITY ARRAY:	(0,0,0,0,1,0,0,0,0)
		// EMBOSS ARRAY:	(-2,-1,0,-1,1,1,0,1,2);
		
		public function Maintxt() {
            //this.filters = [this._convFilter]; 
			//initTween();
			/*******************************************/
			FilterShortcuts.init();
			
			
			
			/*****************************************/
			// constructor code
			initTween();
		}
		
		public function initTween():void {
			var ds:BlurFilter = new BlurFilter();
			
			
			ds.blurX = 15;
			ds.blurY = 15;
			this.filters = [ds];
			Tweener.addTween(this, {_Blur_blurX:0,_Blur_blurY:0, time:2});
		}
		/*
		public function initTween():void {
			//var t1:ITween = BetweenAS3.tween(_matrixArray,  { 0:0, 1:0, 3:0, 4:1, 5:0, 7:0, 8:0 },{ 0: -2, 1: -1, 3: -1, 4:1, 5:1, 7:1, 8:2 }, 2.0, Quad.easeInOut);
			var t1:ITween = BetweenAS3.tween(_matrixArray,  { 0:0, 1:0, 3:0, 4:1, 5:0, 7:0, 8:0 },{ 0: 0, 1: 0, 3: 0, 4:0, 5:0, 7:0, 8:0 }, 2.0, Quad.easeInOut);
			_tween = BetweenAS3.serial(t1);
			_tween.play();
			_tween.addEventListener(TweenEvent.UPDATE, applyFilter);
		}

		private function applyFilter(event:TweenEvent):void {
			_number++;
			_convFilter.matrix = _matrixArray;
			this.filters = [_convFilter];
			
		}
		*/
	} 
}
