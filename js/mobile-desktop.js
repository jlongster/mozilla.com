mobile   = {};
mobile.e = YAHOO.util.Event;
mobile.d = YAHOO.util.Dom;


mobile.autoclearfield = function() {
  
  return {
    init: function() {
      mobile.e.onAvailable("phone", this.fnHandler);
    },
    fnHandler: function(message) {
      mobile.e.addListener(this, "focus", function() 
      {
        if( this.value == this.defaultValue ) 
        {
          this.value = "";
        }
      });
 
      mobile.e.addListener(this, "blur", function() 
      {
        if( !this.value.length ) 
        {
          this.value = this.defaultValue;
        }
      });
    }
  }
}();

mobile.autoclearfield.init();

// append prefix
// if default value, clear it
// otherwise prepend
mobile.addprefix = function() {
  
  return {
    init: function() {
      mobile.e.onAvailable("prefix", this.fnHandler);
    },
    fnHandler: function(message) {
      var phone = mobile.d.get("phone");
      
      if (phone.value == phone.defaultValue)
        phone.disabled = true;
      
      
      mobile.e.addListener(this, "change", function(ev) {
        var code  = ev.target.value;
        if (code != "") {
          phone.value = code + " ";
          phone.focus();
          phone.disabled = false;
        } else {
          phone.value = phone.defaultValue;
          phone.disabled = true;
        }
      
      });
    }
  }
}();

mobile.addprefix.init();

mobile.validateplatform = function() {
  return {
    init: function() {
      mobile.e.onAvailable("download_form", this.fnHandler);
    },
    fnHandler: function(e) {
      var platform = mobile.d.get("platform");
      
      mobile.e.addListener(this, "submit", function(ev) {
        if (platform.selectedIndex == 0) {
         alert("Please choose your phone."); 
         ev.preventDefault();
        }        
      });
    }
  }
}();

mobile.validateplatform.init();