(this["webpackJsonpaqarz-dashboard"]=this["webpackJsonpaqarz-dashboard"]||[]).push([[34],{1390:function(e,a,t){"use strict";t.r(a);var n=t(580),l=t.n(n),r=t(2),c=t(581),m=t(14),i=t(16),s=t(18),o=t(19),u=t(0),d=t.n(u),p=t(585),b=t(744),v=(t(63),t(35),t(122));var E=function(e){return d.a.createElement("div",{className:"invalid-field"},d.a.createElement("div",{className:"invalid-feedback"},e.children))};function h(e){var a=e.label,t=e.name,n=Object(v.a)(e,["label","name"]),l=e.type,r=e.width;return l||(l="text"),r||(r="12"),d.a.createElement("div",{className:"form-group col-md-".concat(r)},d.a.createElement("label",{htmlFor:t},a),d.a.createElement(p.b,Object.assign({id:t,name:t,type:l,className:"form-control"},n)),d.a.createElement(p.a,{name:t,component:E}))}function g(e){var a=e.label,t=e.name,n=e.hideIcon,l=(e.onRemove,Object(v.a)(e,["label","name","hideIcon","onRemove"])),r=e.type,c=e.width;return r||(r="text"),c||(c="12"),d.a.createElement("div",{className:"form-group"},d.a.createElement("div",{className:"input-group"},d.a.createElement("label",{htmlFor:t},a),d.a.createElement(p.b,Object.assign({id:t,name:t,type:r,className:"form-control"},l)),d.a.createElement("div",{className:"input-group-append"},n&&d.a.createElement("button",{className:"btn btn-danger",type:"button",onClick:function(){return e.onRemove()}},d.a.createElement("i",{className:"i-Close"}))),d.a.createElement(p.a,{name:t,component:E})))}var f=function(e){var a=e.label,t=e.name,n=e.options,l=(e.addDefaultItem,e.width),r=Object(v.a)(e,["label","name","options","addDefaultItem","width"]);return l||(l="6"),d.a.createElement("div",{className:"form-group col-md-".concat(l)},d.a.createElement("label",{htmlFor:t},a),d.a.createElement(p.b,Object.assign({as:"select",id:t,name:t},r,{className:"form-control"}),n.map((function(e){return d.a.createElement("option",{key:e.value,value:e.value},e.text)}))),d.a.createElement(p.a,{name:t,component:E}))};var N=function(e){var a=e.label,t=e.name,n=e.options,l=e.onChange,r=Object(v.a)(e,["label","name","options","onChange"]);return d.a.createElement("div",{className:"form-control"},d.a.createElement("label",null,a),d.a.createElement(p.b,{name:t},(function(e){var a=e.form,c=e.field,m=a.setFieldValue;return n.map((function(e){return d.a.createElement(d.a.Fragment,{key:e.text},d.a.createElement("input",Object.assign({type:"radio",id:e.value},c,r,{value:e.value,checked:c.value===e.value,onChange:function(e){m(t,e.target.value),l&&l(e.target.value)}})),d.a.createElement("label",{htmlFor:e.value},e.text))}))})),d.a.createElement(p.a,{component:E,name:t}))};var y=function(e){var a=e.label,t=e.name,n=e.options,l=Object(v.a)(e,["label","name","options"]);return d.a.createElement("div",{className:"form-control"},d.a.createElement("label",null,a),d.a.createElement(p.b,{name:t},(function(e){var a=e.field;return n.map((function(e){return d.a.createElement(d.a.Fragment,{key:e.text},d.a.createElement("input",Object.assign({type:"checkbox",id:e.value},a,l,{value:e.value,checked:a.value.includes(e.value)})),d.a.createElement("label",{htmlFor:e.value},e.text))}))})),d.a.createElement(p.a,{component:E,name:t}))};var w=function(e){var a=e.label,t=e.name,n=e.value,l=e.width,r=Object(v.a)(e,["label","name","value","width"]);return l||(l="4"),d.a.createElement("div",{className:"card-body col-md-".concat(l," form-group mb-3")},d.a.createElement("label",{className:"checkbox checkbox-outline-primary"},d.a.createElement("span",null,a),d.a.createElement(p.b,{name:t},(function(e){var a=e.field;return d.a.createElement(d.a.Fragment,null,d.a.createElement("input",Object.assign({type:"checkbox",id:t},a,r,{value:n,checked:a.value})))})),d.a.createElement("span",{className:"checkmark"})),d.a.createElement(p.a,{component:E,name:t}))};var j=function(e){var a=e.label,t=e.name,n=e.value,l=e.width,r=e.checked,c=Object(v.a)(e,["label","name","value","width","checked"]);return l||(l="4"),d.a.createElement("div",{className:"card-body col-md-".concat(l," form-group mb-3")},d.a.createElement("label",{className:"switch pr-5 switch-primary mr-3"},d.a.createElement("span",null,a),d.a.createElement(p.b,{name:t},(function(e){var a=e.field;return d.a.createElement(d.a.Fragment,null,d.a.createElement("input",Object.assign({type:"checkbox",id:t},a,c,{value:n,checked:r})))}))," ",d.a.createElement("span",{className:"slider"})," "),d.a.createElement(p.a,{component:E,name:t}))},O=t(607),k=t.n(O);t(1050);var F=function(e){var a=e.label,t=e.name,n=Object(v.a)(e,["label","name"]),l=e.width,r=e.format;return l||(l="4"),r||(r="dd-MMM-yyyy"),d.a.createElement("div",{className:"form-group col-md-".concat(l)},d.a.createElement("label",{htmlFor:t},a),d.a.createElement(p.b,{name:t,className:"form-control"},(function(e){var a=e.form,l=e.field,c=a.setFieldValue,m=l.value;return d.a.createElement(k.a,Object.assign({dateFormat:r,autoComplete:"off",id:t},l,n,{selected:m,onChange:function(e){return c(t,e)},className:"form-control"}))})),d.a.createElement(p.a,{component:E,name:t}))};function x(e){var a=e.initialLabel,t=e.loadingLabel,n=e.isSpinnerDisplayed,l=void 0!==n&&n,r=Object(v.a)(e,["initialLabel","loadingLabel","isSpinnerDisplayed"]);return d.a.createElement("button",Object.assign({type:"submit",className:"btn btn-primary col-12",disabled:l?"disabled":""},r),!l&&a,l&&d.a.createElement(d.a.Fragment,null,d.a.createElement("span",null," ",t,"...."),d.a.createElement("span",{className:"spinner-glow spinner-glow-light ml-2",style:{verticalAlign:"middle"}})))}var S=t(67);function C(e){var a=e.name,t=e.onFileChange,n=e.setFieldValue,l=Object(v.a)(e,["name","onFileChange","setFieldValue"]),r=e.label,c=e.width,m=e.multiple;c||(c="6"),r||(r="\u0627\u062e\u062a\u0631 \u0645\u0644\u0641"),m=m||!1;var i=Object(u.useState)(e.imageUrl?e.imageUrl:"/assets/images/placeholder.png"),s=Object(S.a)(i,2),o=s[0],b=s[1],h=Object(u.useState)(!0),g=Object(S.a)(h,2),f=g[0],N=g[1];Object(u.useEffect)((function(){e.imageUrl&&b(e.imageUrl),N(!1)}),[e.imageurl]);return d.a.createElement("div",{className:"item-card-image"},d.a.createElement("img",{className:"card-img",src:o,alt:r}),d.a.createElement("div",{className:"card-img-overlay"},d.a.createElement("div",{className:"upload-image"},d.a.createElement("input",Object.assign({type:"file",className:"custom-file-input",id:a,name:a},l,{onChange:function(e){N(!0),n({name:a},m?e.target.files:e.target.files[0]),t(e),function(e){var a=new FileReader;a.onload=function(){2===a.readyState&&(b(a.result),N(!1))},a.readAsDataURL(e.target.files[0])}(e)}})),d.a.createElement("label",{htmlFor:a,className:"custom-file-label"},d.a.createElement("i",{className:"i-Edit mr-2"})," ","oldFileUploaded"===r?"\u062a\u0639\u062f\u064a\u0644 \u0627\u0644\u0645\u0644\u0641":r),f&&d.a.createElement("div",{className:"spinner spinner-primary mr-3 update-image-spinner"}),d.a.createElement(p.a,{name:a,component:E}))))}function L(e){var a=e.control,t=Object(v.a)(e,["control"]);switch(a){case"input":return d.a.createElement(h,t);case"InputGroup":return d.a.createElement(g,t);case"select":return d.a.createElement(f,t);case"checkbox":return d.a.createElement(w,t);case"switchButton":return d.a.createElement(j,t);case"submitButton":return d.a.createElement(x,t);case"date":return d.a.createElement(F,t);case"radio":return d.a.createElement(N,t);case"checkboxGroup":return d.a.createElement(y,t);case"file":return d.a.createElement(C,t);default:return null}}t(120);var q=t(50),I=(t(10),t(30),b.a().shape({email:b.c().email("Invalid email").required("email is required"),password:b.c().min(8,"Password must be 8 character long").required("password is required")}),function(e){Object(s.a)(t,e);var a=Object(o.a)(t);function t(){var e;Object(m.a)(this,t);for(var n=arguments.length,i=new Array(n),s=0;s<n;s++)i[s]=arguments[s];return(e=a.call.apply(a,[this].concat(i))).state={username:"",password:"",type:"dashboard",showLoadingSpinner:!1},e.handleSubmit=function(){var a=Object(c.a)(l.a.mark((function a(t,n){return l.a.wrap((function(a){for(;;)switch(a.prev=a.next){case 0:n.setSubmitting;try{e.setState(Object(r.a)(Object(r.a)({},t),{},{showLoadingSpinner:!0})),q.a.loginWithEmailAndPassword(t.username,t.password,t.type)}catch(l){e.setState({showLoadingSpinner:!1})}case 2:case"end":return a.stop()}}),a)})));return function(e,t){return a.apply(this,arguments)}}(),e}return Object(i.a)(t,[{key:"componentDidMount",value:function(){document.title="\u062a\u0633\u062c\u064a\u0644 \u0627\u0644\u062f\u062e\u0648\u0644"}},{key:"render",value:function(){var e=this;return d.a.createElement("div",{className:"auth-layout-wrap",dir:"rtl",style:{backgroundImage:"linear-gradient(0deg, rgb(195 148 243), rgb(245 245 245 / 30%)), url(/assets/images/photo-wide-4.jpg)"}},d.a.createElement("div",{className:"auth-content"},d.a.createElement("div",{className:"card o-hidden"},d.a.createElement("div",{className:"row"},d.a.createElement("div",{className:"col-md-12"},d.a.createElement("div",{className:"p-4"},d.a.createElement("div",{className:"auth-logo text-center mb-4"},d.a.createElement("img",{src:"/assets/images/logo.png",alt:""})),d.a.createElement("h1",{className:"mb-3 text-18"},"\u062a\u0633\u062c\u064a\u0644 \u0627\u0644\u062f\u062e\u0648\u0644"),d.a.createElement(p.d,{initialValues:this.state,validationSchema:D,onSubmit:this.handleSubmit,validateOnChange:!1,enableReinitialize:!0},(function(a){return d.a.createElement(p.c,{className:"needs-validation"},d.a.createElement("div",{className:"card-body"},d.a.createElement("div",{className:"form-row"},d.a.createElement(L,{control:"input",label:"\u0627\u0644\u0628\u0631\u064a\u062f \u0627\u0644\u0625\u0644\u0643\u062a\u0631\u0648\u0646\u064a",name:"username",placeholder:"\u0627\u0644\u0628\u0631\u064a\u062f \u0627\u0644\u0625\u0644\u0643\u062a\u0631\u0648\u0646\u064a"})),d.a.createElement("div",{className:"form-row"},d.a.createElement(L,{control:"input",type:"password",label:"\u0643\u0644\u0645\u0629 \u0627\u0644\u0645\u0631\u0648\u0631",name:"password",placeholder:"\u0623\u062f\u062e\u0644 \u0643\u0644\u0645\u0629 \u0627\u0644\u0645\u0631\u0648\u0631"})),d.a.createElement("button",{className:"btn btn-primary btn-block btn-rounded mt-3",type:"submit"},e.state.showLoadingSpinner&&d.a.createElement(d.a.Fragment,null,d.a.createElement("span",null," \u062c\u0627\u0631\u064a \u0627\u0644\u062a\u062d\u0642\u0642...."),d.a.createElement("span",{className:"spinner-glow spinner-glow-light ml-2",style:{verticalAlign:"middle"}})),!e.state.showLoadingSpinner&&"\u062a\u0633\u062c\u064a\u0644 \u0627\u0644\u062f\u062e\u0648\u0644"),d.a.createElement("div",{className:"mt-3 text-center"})))}))))))))}}]),t}(u.Component)),D=b.a().shape({username:b.c().email("\u0627\u0644\u0628\u0631\u064a\u062f \u0627\u0644\u0625\u0644\u0643\u062a\u0631\u0648\u0646\u064a \u063a\u064a\u0631 \u0635\u062d\u064a\u062d.").required("\u0647\u0630\u0627 \u0627\u0644\u062d\u0642\u0644 \u0645\u0637\u0644\u0648\u0628"),password:b.c().required("\u0647\u0630\u0627 \u0627\u0644\u062d\u0642\u0644 \u0645\u0637\u0644\u0648\u0628")});a.default=I}}]);
//# sourceMappingURL=34.ee01e635.chunk.js.map