(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-4d646b10"],{2677:function(t,e,i){"use strict";var n=i("8654");e["a"]=n["a"]},"28f7":function(t,e,i){"use strict";i.r(e);var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-col",[i("div",{staticClass:"page-title py-5"},[t._v("公众号配置")]),i("div",{staticClass:"page-body"},[i("v-card",{staticClass:"page-body-card"},[i("div",{staticClass:"panel"},[i("div",{staticClass:"panel__hd"},[i("div",{staticClass:"panel-title"},[t._v(t._s(t.panel.title))])]),i("div",{staticClass:"panel__bd"},[i("div",{staticClass:"d-flex justify-center align-center py-3"},[i("v-img",{attrs:{src:t.qr_url,"max-width":"200px"}})],1),i("v-form",{ref:"form"},[i("v-row",[t._l(t.items,(function(e,n){return i("v-col",{key:n,staticClass:"d-flex justify-start align-start",attrs:{cols:"12"}},[i("div",{staticClass:"panel-form-label flex-shrink-0"},[t._v(t._s(e.label))]),"qr_code"===e.sign?i("v-file-input",{attrs:{id:"qr_input",outlined:"",rules:t.rules,accept:"image/png, image/jpeg, image/bmp",dense:"","prepend-icon":"","append-icon":"mdi-camera",hint:e.tips,filled:""},on:{change:t.onFileChange,"click:append":t.onAppendClick},model:{value:e.title,callback:function(i){t.$set(e,"title",i)},expression:"item.title"}}):i("v-text-field",{attrs:{outlined:"",dense:"",hint:e.tips},model:{value:e.title,callback:function(i){t.$set(e,"title",i)},expression:"item.title"}})],1)})),i("v-col",{staticClass:"d-flex justify-end",attrs:{cols:"12"}},[i("v-btn",{staticClass:"mr-4 warning",on:{click:t.onCancel}},[t._v("取消")]),i("v-btn",{staticClass:"primary",on:{click:t.onSubmit}},[t._v("提交")])],1)],2)],1)],1)])])],1)])},s=[],a=(i("4160"),i("b0c0"),i("159b"),i("365c")),r={name:"MpCreateAndEdit",data:function(){return{panel:{title:"添加/修改"},qr_url:"",rules:[function(t){return!t||t.size<2e6||"图片不能超过 2 MB!"}],mp_sign:null,params:new FormData,items:[{sign:"qr_code",label:"公众号二维码",title:[],tips:"可通过微信公众号后台设置获取。"},{sign:"name",label:"公众号名称",title:"",tips:"此名称仅为标识，如需修改微信公众号名称，请通过公众号官方后台进行微信认证。"},{sign:"sign",label:"公众号标识",title:"",tips:"此名称仅为自定义标识，建议简短纯英文字母。"},{sign:"app_id",label:"开发者ID(AppID)",title:"",tips:"开发者ID是公众号开发识别码，配合开发者密码可调用公众号的接口能力。"},{sign:"secret",label:"开发者密钥(AppSecret)",title:"",tips:"开发者密码是校验公众号开发者身份的密码，具有极高的安全性。切记勿把密码直接交给第三方开发者或直接存储在代码中。如需第三方代开发公众号，请使用授权方式接入。"},{sign:"token",label:"令牌(Token)",title:"",tips:"需与微信公众号平台设置一致，方可成功解析微信转发的消息。"},{sign:"aes_key",label:"AESKey",title:"",tips:"加密消息密钥，如您采用明文传输，可不必填写。"},{sign:"raw_id",label:"原始 id(raw_id)",title:"",tips:"原始 id 可在公众号后台，公众号设置底部找到。"}]}},mounted:function(){var t=this;"mp-edit"===this.$route.name&&(this.mp_sign=this.$route.params.mp_sign,this.mp_sign&&Object(a["n"])(this.mp_sign).then((function(e){t.qr_url=e.data.qr_url,t.items.forEach((function(i,n){var s=i.sign;"qr_code"!==s&&(t.items[n].title=e.data[s])}))})))},methods:{onCancel:function(){history.go(-1)},onSubmit:function(){var t=this;this.params=new FormData,this.items.forEach((function(e){t.params.append(e.sign,e.title)})),"mp-edit"===this.$route.name?(this.params.append("_method","PUT"),Object(a["u"])(this.mp_sign,this.params).then((function(){t.$store.commit("setSnackbar",{message:"修改成功",color:"success",timeout:1500,show:!0}),setTimeout((function(){t.onCancel()}),1500)}))):Object(a["d"])(this.params).then((function(){t.$store.commit("setSnackbar",{message:"创建成功",color:"success",timeout:1500,show:!0}),setTimeout((function(){t.onCancel()}),1500)}))},onFileChange:function(t){var e=this;if(!t)return this.qr_url="";var i=new FileReader;i.readAsDataURL(t),i.onload=function(){e.qr_url=i.result}},onAppendClick:function(){document.getElementById("qr_input").click()}}},o=r,c=i("2877"),l=i("6544"),u=i.n(l),h=i("8336"),d=i("b0af"),p=i("62ad"),f=(i("99af"),i("a623"),i("caad"),i("d81d"),i("13d5"),i("fb6a"),i("a434"),i("a9e3"),i("2909")),m=i("5530"),g=i("53ca"),v=(i("5803"),i("2677")),S=i("cc20"),y=i("80d2"),b=i("d9bd"),_=v["a"].extend({name:"v-file-input",model:{prop:"value",event:"change"},props:{chips:Boolean,clearable:{type:Boolean,default:!0},counterSizeString:{type:String,default:"$vuetify.fileInput.counterSize"},counterString:{type:String,default:"$vuetify.fileInput.counter"},placeholder:String,prependIcon:{type:String,default:"$file"},readonly:{type:Boolean,default:!1},showSize:{type:[Boolean,Number],default:!1,validator:function(t){return"boolean"===typeof t||[1e3,1024].includes(t)}},smallChips:Boolean,truncateLength:{type:[Number,String],default:22},type:{type:String,default:"file"},value:{default:void 0,validator:function(t){return Object(y["E"])(t).every((function(t){return null!=t&&"object"===Object(g["a"])(t)}))}}},computed:{classes:function(){return Object(m["a"])({},v["a"].options.computed.classes.call(this),{"v-file-input":!0})},computedCounterValue:function(){var t=this.isMultiple&&this.lazyValue?this.lazyValue.length:this.lazyValue instanceof File?1:0;if(!this.showSize)return this.$vuetify.lang.t(this.counterString,t);var e=this.internalArrayValue.reduce((function(t,e){var i=e.size,n=void 0===i?0:i;return t+n}),0);return this.$vuetify.lang.t(this.counterSizeString,t,Object(y["u"])(e,1024===this.base))},internalArrayValue:function(){return Object(y["E"])(this.internalValue)},internalValue:{get:function(){return this.lazyValue},set:function(t){this.lazyValue=t,this.$emit("change",this.lazyValue)}},isDirty:function(){return this.internalArrayValue.length>0},isLabelActive:function(){return this.isDirty},isMultiple:function(){return this.$attrs.hasOwnProperty("multiple")},text:function(){var t=this;return this.isDirty?this.internalArrayValue.map((function(e){var i=e.name,n=void 0===i?"":i,s=e.size,a=void 0===s?0:s,r=t.truncateText(n);return t.showSize?"".concat(r," (").concat(Object(y["u"])(a,1024===t.base),")"):r})):[this.placeholder]},base:function(){return"boolean"!==typeof this.showSize?this.showSize:void 0},hasChips:function(){return this.chips||this.smallChips}},watch:{readonly:{handler:function(t){!0===t&&Object(b["b"])("readonly is not supported on <v-file-input>",this)},immediate:!0},value:function(t){var e=this.isMultiple?t:t?[t]:[];Object(y["j"])(e,this.$refs.input.files)||(this.$refs.input.value="")}},methods:{clearableCallback:function(){this.internalValue=this.isMultiple?[]:void 0,this.$refs.input.value=""},genChips:function(){var t=this;return this.isDirty?this.text.map((function(e,i){return t.$createElement(S["a"],{props:{small:t.smallChips},on:{"click:close":function(){var e=t.internalValue;e.splice(i,1),t.internalValue=e}}},[e])})):[]},genInput:function(){var t=v["a"].options.methods.genInput.call(this);return delete t.data.domProps.value,delete t.data.on.input,t.data.on.change=this.onInput,[this.genSelections(),t]},genPrependSlot:function(){var t=this;if(!this.prependIcon)return null;var e=this.genIcon("prepend",(function(){t.$refs.input.click()}));return this.genSlot("prepend","outer",[e])},genSelectionText:function(){var t=this.text.length;return t<2?this.text:this.showSize&&!this.counter?[this.computedCounterValue]:[this.$vuetify.lang.t(this.counterString,t)]},genSelections:function(){var t=this,e=[];return this.isDirty&&this.$scopedSlots.selection?this.internalArrayValue.forEach((function(i,n){t.$scopedSlots.selection&&e.push(t.$scopedSlots.selection({text:t.text[n],file:i,index:n}))})):e.push(this.hasChips&&this.isDirty?this.genChips():this.genSelectionText()),this.$createElement("div",{staticClass:"v-file-input__text",class:{"v-file-input__text--placeholder":this.placeholder&&!this.isDirty,"v-file-input__text--chips":this.hasChips&&!this.$scopedSlots.selection}},e)},genTextFieldSlot:function(){var t=this,e=v["a"].options.methods.genTextFieldSlot.call(this);return e.data.on=Object(m["a"])({},e.data.on||{},{click:function(){return t.$refs.input.click()}}),e},onInput:function(t){var e=Object(f["a"])(t.target.files||[]);this.internalValue=this.isMultiple?e:e[0],this.initialValue=this.internalValue},onKeyDown:function(t){this.$emit("keydown",t)},truncateText:function(t){if(t.length<Number(this.truncateLength))return t;var e=Math.floor((Number(this.truncateLength)-1)/2);return"".concat(t.slice(0,e),"…").concat(t.slice(t.length-e))}}}),C=i("4bd4"),$=i("adda"),z=i("0fd9"),w=i("8654"),x=Object(c["a"])(o,n,s,!1,null,"b81688c6",null);e["default"]=x.exports;u()(x,{VBtn:h["a"],VCard:d["a"],VCol:p["a"],VFileInput:_,VForm:C["a"],VImg:$["a"],VRow:z["a"],VTextField:w["a"]})},"36a7":function(t,e,i){},5803:function(t,e,i){},"8efc":function(t,e,i){},adda:function(t,e,i){"use strict";i("a15b"),i("a9e3"),i("8efc");var n=i("90a2"),s=(i("36a7"),i("24b2")),a=i("58df"),r=Object(a["a"])(s["a"]).extend({name:"v-responsive",props:{aspectRatio:[String,Number]},computed:{computedAspectRatio:function(){return Number(this.aspectRatio)},aspectStyle:function(){return this.computedAspectRatio?{paddingBottom:1/this.computedAspectRatio*100+"%"}:void 0},__cachedSizer:function(){return this.aspectStyle?this.$createElement("div",{style:this.aspectStyle,staticClass:"v-responsive__sizer"}):[]}},methods:{genContent:function(){return this.$createElement("div",{staticClass:"v-responsive__content"},this.$slots.default)}},render:function(t){return t("div",{staticClass:"v-responsive",style:this.measurableStyles,on:this.$listeners},[this.__cachedSizer,this.genContent()])}}),o=r,c=i("d9bd");e["a"]=o.extend({name:"v-img",directives:{intersect:n["a"]},props:{alt:String,contain:Boolean,eager:Boolean,gradient:String,lazySrc:String,options:{type:Object,default:function(){return{root:void 0,rootMargin:void 0,threshold:void 0}}},position:{type:String,default:"center center"},sizes:String,src:{type:[String,Object],default:""},srcset:String,transition:{type:[Boolean,String],default:"fade-transition"}},data:function(){return{currentSrc:"",image:null,isLoading:!0,calculatedAspectRatio:void 0,naturalWidth:void 0}},computed:{computedAspectRatio:function(){return Number(this.normalisedSrc.aspect||this.calculatedAspectRatio)},hasIntersect:function(){return"undefined"!==typeof window&&"IntersectionObserver"in window},normalisedSrc:function(){return"string"===typeof this.src?{src:this.src,srcset:this.srcset,lazySrc:this.lazySrc,aspect:Number(this.aspectRatio||0)}:{src:this.src.src,srcset:this.srcset||this.src.srcset,lazySrc:this.lazySrc||this.src.lazySrc,aspect:Number(this.aspectRatio||this.src.aspect)}},__cachedImage:function(){if(!this.normalisedSrc.src&&!this.normalisedSrc.lazySrc)return[];var t=[],e=this.isLoading?this.normalisedSrc.lazySrc:this.currentSrc;this.gradient&&t.push("linear-gradient(".concat(this.gradient,")")),e&&t.push('url("'.concat(e,'")'));var i=this.$createElement("div",{staticClass:"v-image__image",class:{"v-image__image--preload":this.isLoading,"v-image__image--contain":this.contain,"v-image__image--cover":!this.contain},style:{backgroundImage:t.join(", "),backgroundPosition:this.position},key:+this.isLoading});return this.transition?this.$createElement("transition",{attrs:{name:this.transition,mode:"in-out"}},[i]):i}},watch:{src:function(){this.isLoading?this.loadImage():this.init(void 0,void 0,!0)},"$vuetify.breakpoint.width":"getSrc"},mounted:function(){this.init()},methods:{init:function(t,e,i){if(!this.hasIntersect||i||this.eager){if(this.normalisedSrc.lazySrc){var n=new Image;n.src=this.normalisedSrc.lazySrc,this.pollForSize(n,null)}this.normalisedSrc.src&&this.loadImage()}},onLoad:function(){this.getSrc(),this.isLoading=!1,this.$emit("load",this.src)},onError:function(){Object(c["b"])("Image load failed\n\n"+"src: ".concat(this.normalisedSrc.src),this),this.$emit("error",this.src)},getSrc:function(){this.image&&(this.currentSrc=this.image.currentSrc||this.image.src)},loadImage:function(){var t=this,e=new Image;this.image=e,e.onload=function(){e.decode?e.decode().catch((function(e){Object(c["c"])("Failed to decode image, trying to render anyway\n\n"+"src: ".concat(t.normalisedSrc.src)+(e.message?"\nOriginal error: ".concat(e.message):""),t)})).then(t.onLoad):t.onLoad()},e.onerror=this.onError,e.src=this.normalisedSrc.src,this.sizes&&(e.sizes=this.sizes),this.normalisedSrc.srcset&&(e.srcset=this.normalisedSrc.srcset),this.aspectRatio||this.pollForSize(e),this.getSrc()},pollForSize:function(t){var e=this,i=arguments.length>1&&void 0!==arguments[1]?arguments[1]:100,n=function n(){var s=t.naturalHeight,a=t.naturalWidth;s||a?(e.naturalWidth=a,e.calculatedAspectRatio=a/s):null!=i&&setTimeout(n,i)};n()},genContent:function(){var t=o.options.methods.genContent.call(this);return this.naturalWidth&&this._b(t.data,"div",{style:{width:"".concat(this.naturalWidth,"px")}}),t},__genPlaceholder:function(){if(this.$slots.placeholder){var t=this.isLoading?[this.$createElement("div",{staticClass:"v-image__placeholder"},this.$slots.placeholder)]:[];return this.transition?this.$createElement("transition",{props:{appear:!0,name:this.transition}},t):t[0]}}},render:function(t){var e=o.options.render.call(this,t);return e.data.staticClass+=" v-image",e.data.directives=this.hasIntersect?[{name:"intersect",options:this.options,modifiers:{once:!0},value:this.init}]:[],e.data.attrs={role:this.alt?"img":void 0,"aria-label":this.alt},e.children=[this.__cachedSizer,this.__cachedImage,this.__genPlaceholder(),this.genContent()],t(e.tag,e.data,e.children)}})}}]);
//# sourceMappingURL=chunk-4d646b10.bf8e5c5d.js.map