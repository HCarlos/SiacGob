//var oUser = new Object();

function oObject() {
	var doctoper = [];
	var oUser = [0,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,
				false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,0];
	var minHeight = 0;
	var pHost = ["http://siac.tabascoweb.com/",/iphone|ipad|ipod|android/i.test(navigator.userAgent), false, /msie\s6/i.test(navigator.userAgent)];
	
	var cat = [];
	var index = 0;
	var height = 100; 
	var sep = "_devch_";
	var newPos = "";
	var dom    = "";
	var id     = 0;
	var lat    = "";
	var lon    = "";
	var init   = false;

	var getInstance = function() {
	    if (!oObject.singletonInstance) {
			oObject.singletonInstance = createInstance();
	    }
	    return oObject.singletonInstance;
	}

	var createInstance = function() {
		return {
			setDP : function(name) {
				doctoper.push(name);
				return this.getDP();
			},
			getDP : function() {
				return doctoper;
			},
			getValue : function(i) {
				return pHost[i];
			},
			setUser : function(i,value) {
				oUser[i]=value;
			},
			getUser : function(i) {
				return oUser[i];
			},
			setMinHeight : function(value) {
				minHeight=value;
			},
			getMinHeight : function() {
				return minHeight;
			}
			
		}
	}
	
	var getInternetExplorerVersion = function(){
	    var rv = -1; // Return value assumes failure.
	    if (navigator.appName == 'Microsoft Internet Explorer')
	    {
	        var ua = navigator.userAgent;
	        var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
	    if (re.exec(ua) != null)
	        rv = parseFloat( RegExp.$1 );
	    }
	    return rv;
	}

	var checkVersion = function(){
	    var msg = "You're not using Internet Explorer.";
	    var ver = getInternetExplorerVersion();
	
	    if ( ver > -1 )
	    {
	        if ( ver >= 8.0 ) 
	            msg = "You're using a recent copy of Internet Explorer."
	        else
	            msg = "You should upgrade your copy of Internet Explorer.";
	    }
	    alert( msg );
	
	}

	return getInstance();
}


var obj = new oObject();
//alert(obj.getValue(0));

