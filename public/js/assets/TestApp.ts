//declare var angular: any;
namespace TestApp {
	class TestApp implements {
		static $inject = [];
		static $onInit = () => { };
		constructor(){
		}
		
		Tekst: string = "";
		BtnClick = () => {
			this.Tekst = "hallo daar";
		}
	}
	
	ng.module("TestApp", ["ngRoute"])
		.controller("TestApp", TestApp);
}
