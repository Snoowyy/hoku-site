(()=>{"use strict";var e={};function t(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}function n(e,n){if(e){if("string"==typeof e)return t(e,n);var r=Object.prototype.toString.call(e).slice(8,-1);return"Object"===r&&e.constructor&&(r=e.constructor.name),"Map"===r||"Set"===r?Array.from(e):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?t(e,n):void 0}}function r(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var r,o,l,a,i=[],s=!0,c=!1;try{if(l=(n=n.call(e)).next,0===t){if(Object(n)!==n)return;s=!1}else for(;!(s=(r=l.call(n)).done)&&(i.push(r.value),i.length!==t);s=!0);}catch(e){c=!0,o=e}finally{try{if(!s&&null!=n.return&&(a=n.return(),Object(a)!==a))return}finally{if(c)throw o}}return i}}(e,t)||n(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}e.n=t=>{var n=t&&t.__esModule?()=>t.default:()=>t;return e.d(n,{a:n}),n},e.d=(t,n)=>{for(var r in n)e.o(n,r)&&!e.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:n[r]})},e.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t);const o=window.wp.element,l=window.wp.components,a=window.wp.i18n,i=window.wp.domReady;var s=e.n(i);const c=window.wp.apiFetch;var u=e.n(c);function p(e){return p="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},p(e)}function m(e,t,n){return(t=function(e){var t=function(e,t){if("object"!==p(e)||null===e)return e;var n=e[Symbol.toPrimitive];if(void 0!==n){var r=n.call(e,"string");if("object"!==p(r))return r;throw new TypeError("@@toPrimitive must return a primitive value.")}return String(e)}(e);return"symbol"===p(t)?t:String(t)}(t))in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function b(e){return function(e){if(Array.isArray(e))return t(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||n(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function d(e,t){if(null==e)return{};var n,r,o=function(e,t){if(null==e)return{};var n,r,o={},l=Object.keys(e);for(r=0;r<l.length;r++)n=l[r],t.indexOf(n)>=0||(o[n]=e[n]);return o}(e,t);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);for(r=0;r<l.length;r++)n=l[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(o[n]=e[n])}return o}function f(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function g(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?f(Object(n),!0).forEach((function(t){m(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):f(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var y=[{label:(0,a.__)("Only run if","newsletter-optin-box"),value:"allow"},{label:(0,a.__)("Do not run if","newsletter-optin-box"),value:"prevent"}],_=[{label:(0,a.__)("all","newsletter-optin-box"),value:"all"},{label:(0,a.__)("any","newsletter-optin-box"),value:"any"}];function h(e,t){return[{label:t,value:"",disabled:!0}].concat(b(e))}function v(e){var t=e.type,n=e.action,r=e.ruleCount,i=e.setConditionalLogicAttribute,s=r>1;return(0,o.createElement)(l.Flex,{className:"noptin-component__field-lg",wrap:!0},(0,o.createElement)(l.FlexItem,null,(0,o.createElement)(l.SelectControl,{label:(0,a.__)("If","newsletter-optin-box"),hideLabelFromVision:!0,value:n||"allow",options:y,onChange:function(e){return i("action",e)},size:"default",__nextHasNoMarginBottom:!0})),s&&(0,o.createElement)(o.Fragment,null,(0,o.createElement)(l.FlexItem,null,(0,o.createElement)(l.SelectControl,{label:(0,a.__)("all","newsletter-optin-box"),hideLabelFromVision:!0,value:t||"all",options:_,onChange:function(e){return i("type",e)},size:"default",__nextHasNoMarginBottom:!0})),(0,o.createElement)(l.FlexBlock,null,(0,a.__)("of the following rules are true:","newsletter-optin-box"))))}function w(e){var t=e.rule,n=e.comparisons,r=e.availableConditionTypes,i=e.updateRule,s=e.removeRule,c=e.conditionType,u=e.isLastRule,p=(e.isFirstRule,(0,o.useMemo)((function(){return e=t.type,r[e]||{};var e}),[r,t.type])),m=(0,o.useMemo)((function(){return e=p.options,t=[],e?Array.isArray(e)?(e.forEach((function(e,n){t.push({label:e,value:n})})),t):(Object.keys(e).forEach((function(n){t.push({label:e[n],value:n})})),t):t;var e,t}),[p]),b=m.length>0,d=(0,o.useMemo)((function(){return p.type?p.type:"string"}),[p]),f=(0,o.useMemo)((function(){var e=[];return Object.keys(n).forEach((function(t){var r=n[t].type;if(b){if("string"===d&&"is"!=t&&"is_not"!=t)return;if("is_empty"===t||"is_not_empty"===t||"is_between"===t)return}"any"!==r&&r!=d||e.push({label:n[t].name,value:t})})),e}),[d]),g="",y=[];Object.keys(r).forEach((function(e){var t=r[e];""===g&&(g=t.type),y.push({label:t.label,value:e})}));var _=function(e,n){i(e,n),"type"!==e&&""===t.type&&i("type",g),"condition"!==e&&""===t.condition&&i("condition","is"),"type"===e&&(i("condition","is"),i("value",""))},v="is_empty"===t.condition||"is_not_empty"===t.condition,w=b&&!v,x=!b&&!v;return(0,o.createElement)(l.Flex,{className:"noptin-component__field-lg",wrap:!0},(0,o.createElement)(l.FlexItem,null,(0,o.createElement)(l.SelectControl,{label:(0,a.__)("Condition Type","newsletter-optin-box"),hideLabelFromVision:!0,value:t.type?t.type:g,options:h(y,(0,a.__)("Select a condition","newsletter-optin-box")),onChange:function(e){return _("type",e)},size:"default",__nextHasNoMarginBottom:!0})),(0,o.createElement)(l.FlexItem,null,(0,o.createElement)(l.SelectControl,{label:(0,a.__)("Comparison","newsletter-optin-box"),hideLabelFromVision:!0,value:t.condition?t.condition:"is",options:h(f,(0,a.__)("Select a comparison","newsletter-optin-box")),onChange:function(e){return _("condition",e)},size:"default",__nextHasNoMarginBottom:!0})),(0,o.createElement)(l.FlexItem,null,w&&(0,o.createElement)(l.SelectControl,{label:(0,a.__)("Value","newsletter-optin-box"),hideLabelFromVision:!0,value:t.value?t.value:"",options:h(m,(0,a.__)("Select a value","newsletter-optin-box")),onChange:function(e){return i("value",e)},size:"default",__nextHasNoMarginBottom:!0}),x&&(0,o.createElement)(l.TextControl,{type:"number"===d?"number":"text",label:(0,a.__)("Value","newsletter-optin-box"),hideLabelFromVision:!0,value:t.value?t.value:"",onChange:function(e){return i("value",e)},__nextHasNoMarginBottom:!0})),(0,o.createElement)(l.FlexItem,null,(0,o.createElement)(l.Button,{onClick:s,icon:"trash"})),(0,o.createElement)(l.FlexBlock,null,!u&&(0,o.createElement)(o.Fragment,null,"any"===c&&(0,a.__)("or","newsletter-optin-box"),"all"===c&&(0,a.__)("and","newsletter-optin-box"))))}function x(e){var t=e.rules,n=e.conditionType,r=e.comparisons,i=e.availableSmartTags,s=e.setConditionalLogicAttribute,c=Array.isArray(t)?t:[],u=(0,o.useMemo)((function(){var e={};return i.forEach((function(t){t.conditional_logic&&(e[t.smart_tag]={key:t.smart_tag,label:t.label,options:t.options,type:t.conditional_logic,placeholder:t.placeholder?t.placeholder:""})})),e}),[i]),p=c.length;return(0,o.createElement)("div",{className:"noptin-conditional-logic-rules"},c.map((function(e,t){return(0,o.createElement)(w,{key:t,rule:e,updateRule:function(e,n){return function(e,t,n){var r=b(c);r[e][t]=n,s("rules",r)}(t,e,n)},removeRule:function(){return function(e){var t=b(c);t.splice(e,1),s("rules",t)}(t)},availableConditionTypes:u,isLastRule:t===p-1,isFirstRule:0===t,conditionType:n,comparisons:r})})),(0,o.createElement)(l.Button,{className:"noptin-add-conditional-rule",onClick:function(){var e=Object.keys(u)[0],t=u[e].options,n=u[e].placeholder?u[e].placeholder:"",r=Array.isArray(t)&&t.length?Object.keys(t)[0]:n,o=b(c);o.push({type:e,condition:"is",value:r}),s("rules",o)},variant:"secondary"},0===p?(0,a.__)("Add a rule","newsletter-optin-box"):(0,a.__)("Add another rule","newsletter-optin-box")))}function E(e){var t=e.onChange,n=e.value,r=e.comparisons,i=e.toggleText,s=e.availableSmartTags,c=e.className;"object"!==p(n)&&(n={enabled:!1,action:"allow",rules:[{condition:"is",type:"date",value:""}],type:"all"});var u=function(e,r){t(g(g({},n),{},m({},e,r)))};return(0,o.createElement)("div",{className:c},(0,o.createElement)(l.ToggleControl,{checked:!!n.enabled,onChange:function(e){return u("enabled",e)},className:"noptin-component__field",label:i||(0,a.__)("Optionally enable/disable this trigger depending on specific conditions.","newsletter-optin-box"),__nextHasNoMarginBottom:!0}),n.enabled&&(0,o.createElement)(o.Fragment,null,(0,o.createElement)(v,{ruleCount:n.rules?n.rules.length:0,type:n.type,action:n.action,setConditionalLogicAttribute:u}),(0,o.createElement)(x,{rules:n.rules,conditionType:n.type,comparisons:r,availableSmartTags:s,setConditionalLogicAttribute:u})))}var O=function(e){var t=e.mergeTag,n=e.onMergeTagClick,r=function(){if(t.example)return t.example;var e="default value";return t.replacement&&(e=t.replacement),t.default&&(e=t.default),e?"".concat(t.smart_tag,' default="').concat(e,'"'):"".concat(t.smart_tag)},l=t.description&&t.description!==t.label;return(0,o.createElement)("tr",{className:"noptin-merge-tag"},(0,o.createElement)("td",null,(0,o.createElement)("label",null,(0,o.createElement)("span",{className:"noptin-merge-tag-label"},t.label),(0,o.createElement)("input",{type:"text",className:"widefat",value:"[[".concat(r(),"]]"),onFocus:function(e){e.target.select(),n&&n("[[".concat(r(),"]]"))},readOnly:!0})),l&&(0,o.createElement)("p",{className:"description noptin-mb0"},t.description)))},C=function(e){var t=e.availableSmartTags,n=e.onMergeTagClick;return(0,o.createElement)("div",{className:"noptin-merge-tags-wrapper"},(0,o.createElement)("table",{className:"widefat striped"},(0,o.createElement)("tbody",null,t.map((function(e){return(0,o.createElement)(O,{key:e.smart_tag,mergeTag:e,onMergeTagClick:n})})))))},S=function(e){var t=e.isOpen,n=e.closeModal,r=e.availableSmartTags,i=e.onMergeTagClick;return(0,o.createElement)(o.Fragment,null,t&&(0,o.createElement)(l.Modal,{title:(0,a.__)("Smart Tags","newsletter-optin-box"),onRequestClose:n},(0,o.createElement)("div",{className:"noptin-component__field-lg noptin-component__field-noptin_description"},(0,o.createElement)(l.Tip,null,(0,a.__)("You can use the following smart tags to generate dynamic values.","newsletter-optin-box"))),(0,o.createElement)(C,{availableSmartTags:r,onMergeTagClick:i})))},k=["setting","availableSmartTags","isPressEnterToChange"],j=["setting","availableSmartTags","value","onChange"],T=["setting","value","options","onChange"];function P(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function N(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?P(Object(n),!0).forEach((function(t){m(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):P(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var A=["number","search","email","password","tel","url","date"];function F(e){var t=e.setting,n=e.availableSmartTags,a=e.isPressEnterToChange,i=d(e,k);void 0===a&&(a=!0);var s=r(M(n,(0,o.useCallback)((function(e){i.onChange&&i.onChange(i.value?i.value+e:e)}),[i.value,i.onChange])),2),c=s[0],u=s[1];return t.disabled&&(i.readOnly=!0,i.onFocus=function(e){return e.target.select()}),(0,o.createElement)(o.Fragment,null,u,(0,o.createElement)(l.__experimentalInputControl,N(N({},i),{},{type:A.includes(t.type)?t.type:"text",placeholder:t.placeholder?t.placeholder:"",suffix:c,isPressEnterToChange:a,__nextHasNoMarginBottom:!0,__next36pxDefaultSize:!0})))}var B=[{id:"key",label:(0,a.__)("Key","noptin-addons-pack"),type:"text"},{id:"value",label:(0,a.__)("Value","noptin-addons-pack"),type:"text"}];function M(e,t){var n=r((0,o.useState)(!1),2),i=n[0],s=n[1],c=(0,o.useCallback)((function(){s(!1)}),[s]),u=(0,o.useCallback)((function(e){t&&(t(e),c())})),p=null,m=null;return Array.isArray(e)&&e.length>0&&(m=(0,o.createElement)(S,{isOpen:i,closeModal:c,availableSmartTags:e,onMergeTagClick:u}),p=(0,o.createElement)(l.Button,{icon:"shortcode",variant:"tertiary",isPressed:i,label:(0,a.__)("Insert merge tag","newsletter-optin-box"),onClick:function(){s(!0)},showTooltip:!0})),[p,m]}function D(e){var t=e.setting,n=e.availableSmartTags,i=e.value,s=e.onChange,c=d(e,j),u=r((0,o.useState)(!1),2),p=u[0],m=u[1],f=r(M(n,(0,o.useCallback)((function(e){Array.isArray(p)&&((i=b(i))[p[0]][p[1]]+=e,s(i))}),[p,i,s])),2),g=f[0],y=f[1],_=(0,l.useBaseControlProps)(c),h=_.baseControlProps,v=_.controlProps;Array.isArray(i)||(i=[]);var w=(0,o.useCallback)((function(e){var t=e.item,n=e.field,r=e.index,i=e.onChange;return(0,o.createElement)(l.FlexBlock,null,(0,o.createElement)(l.__experimentalInputControl,{label:n.label,type:n.type,value:void 0===t[n.id]?"":t[n.id],placeholder:(0,a.sprintf)((0,a.__)("Enter %s","noptin-addons-pack"),n.label),className:"noptin-component__field noptin-condition-field",suffix:g,onChange:i,onFocus:function(){m([r,n.id])},isPressEnterToChange:!0,__nextHasNoMarginBottom:!0,__next36pxDefaultSize:!0}))}),[g]),x=(0,o.useCallback)((function(e){var t=e.item,n=e.index;return(0,o.createElement)(l.Flex,{className:"noptin-repeater-item",wrap:!0},B.map((function(e,r){return(0,o.createElement)(w,{key:r,index:n,item:t,field:e,onChange:function(t){var r=b(i);r[n][e.id]=t,s(r)}})})),(0,o.createElement)(l.FlexItem,null,(0,o.createElement)(l.Button,{icon:"trash",variant:"tertiary",className:"noptin-component__field",label:(0,a.__)("Delete","noptin-addons-pack"),showTooltip:!0,onClick:function(){var e=b(i);e.splice(n,1),s(e)}})))}),[i,s]);return(0,o.createElement)(l.BaseControl,N({},h),y,(0,o.createElement)("div",N({},v),i.map((function(e,t){return(0,o.createElement)(x,{key:t,item:e,index:t})})),(0,o.createElement)(l.Button,{onClick:function(){var e=b(i);e.push({}),s(e)},variant:"secondary"},t.add_field?t.add_field:(0,a.__)("Add","newsletter-optin-box"))))}function I(e){e.setting;var t=e.value,n=e.options,r=e.onChange,a=d(e,T),i=(0,l.useBaseControlProps)(a),s=i.baseControlProps,c=i.controlProps;return Array.isArray(t)||(t=[]),(0,o.createElement)(l.BaseControl,N({},s),(0,o.createElement)("div",N({},c),n.map((function(e,n){return(0,o.createElement)(l.CheckboxControl,{key:n,label:e.label,checked:t.includes(e.value),onChange:function(n){r(n?[].concat(b(t),[e.value]):t.filter((function(t){return t!==e.value})))}})}))))}function H(e){var t=e.settingKey,n=e.setting,r=e.availableSmartTags,i=e.prop,s=e.saved,c=e.setAttributes,u=(0,o.useCallback)((function(e){if(!i)return c(m({},t,e));var n=s[i]?s[i]:{},r=m({},i,N(N({},n),{},m({},t,e)));c(r)}),[t,i,s,c]);if(n.if||n.restrict){var p=n.restrict?n.restrict.split("."):n.if.split(".");if(!(2!==p.length||s[p[0]]&&s[p[0]][p[1]]))return null;if(1===p.length&&!s[p[0]])return null}if(n.condition&&!n.condition(s))return null;var b=s[t];i&&(b=s[i]?s[i][t]:void 0),(void 0===b||n.disabled)&&(b=n.default);var d=void 0!==b&&""!==b&&null!==b,f=[];n.options&&(f=Object.keys(n.options).map((function(e){return{label:n.options[e],value:e}})));var g=n.fullWidth?"noptin-component__field noptin-component__field-".concat(t):"noptin-component__field-lg noptin-component__field-".concat(t),y=n.description?(0,o.createElement)("span",{dangerouslySetInnerHTML:{__html:n.description}}):"",_={label:n.label,value:d?b:"",onChange:u,className:"".concat(g),help:y};return"select"===n.el?(f.unshift({label:n.placeholder?n.placeholder:(0,a.__)("Select an option","newsletter-optin-box"),value:"",disabled:!n.canSelectPlaceholder}),(0,o.createElement)(l.SelectControl,N(N({},_),{},{options:f,__nextHasNoMarginBottom:!0,__next36pxDefaultSize:!0}))):"form_token"===n.el?(0,o.createElement)(l.FormTokenField,N(N({},_),{},{value:Array.isArray(_.value)?_.value:[],suggestions:Array.isArray(n.suggestions)?n.suggestions:[],__nextHasNoMarginBottom:!0,__next40pxDefaultSize:!0})):"multi_checkbox"===n.el||"multi_checkbox_alt"===n.el?(0,o.createElement)(I,N(N({},_),{},{options:f})):"conditional_logic"===n.el?(0,o.createElement)(E,N(N({},_),{},{availableSmartTags:r,comparisons:n.comparisons,toggleText:n.toggle_text})):"input"===n.el?n.type&&["toggle","switch","checkbox","checkbox_alt"].includes(n.type)?(0,o.createElement)(l.ToggleControl,N(N({},_),{},{checked:!!d&&b,onChange:function(e){u(e)}})):(0,o.createElement)(F,N(N({},_),{},{setting:n,availableSmartTags:"trigger_settings"===i?[]:r,isPressEnterToChange:!n.isInputToChange})):"textarea"===n.el?(0,o.createElement)(l.TextareaControl,N(N({},_),{},{setting:n,placeholder:n.placeholder?n.placeholder:"",__nextHasNoMarginBottom:!0})):"paragraph"===n.el?(0,o.createElement)("div",{className:g},(0,o.createElement)(l.Tip,null,n.content)):"hero"===n.el?(0,o.createElement)("div",{className:g},(0,o.createElement)("h3",null,n.content)):"key_value_repeater"===n.el||"webhook_key_value_repeater"===n.el?(0,o.createElement)(D,N(N({},_),{},{setting:n,availableSmartTags:"trigger_settings"===i?[]:r})):t}function K(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function L(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?K(Object(n),!0).forEach((function(t){m(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):K(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function R(e){var t=e.title,n=e.description,i=e.settings,s=e.handler,c=e.saved,u=e.onClickNext,p=e.onClickBack,m=e.isLastStep,b=e.isFirstStep,d=i.reduce((function(e,t){return e[t.settingKey]=c[t.settingKey]?c[t.settingKey]:"",e}),{}),f=r((0,o.useState)(d),2),g=f[0],y=f[1];return(0,o.createElement)(o.Fragment,null,(0,o.createElement)(l.CardHeader,null,(0,o.createElement)("h3",null,t)),n&&(0,o.createElement)(l.CardBody,null,(0,o.createElement)(l.Tip,null,n)),(0,o.createElement)(l.CardBody,null,i.map((function(e,t){return(0,o.createElement)(H,{key:t,settingKey:e.settingKey,saved:g,setAttributes:function(e){return y(L(L({},g),e))},setting:e})}))),(0,o.createElement)(l.CardFooter,null,!b&&(0,o.createElement)(l.Button,{variant:"secondary",onClick:p},(0,o.createElement)(l.Icon,{icon:"arrow-left-alt2"}),(0,a.__)("Back","newsletter-optin-box")),!m&&(0,o.createElement)(l.Button,{variant:"primary",onClick:function(){return s(g,u)}},(0,a.__)("Next","newsletter-optin-box"),(0,o.createElement)(l.Icon,{icon:"arrow-right-alt2"}))))}function z(e,t){u()({path:"/noptin/v1/settings",method:"POST",data:{settings:e}}).catch((function(e){console.error(e)})),t(e)}var V=(0,a.__)("Thank You","newsletter-optin-box"),Y=(0,a.__)("You have successfully subscribed to this newsletter.","newsletter-optin-box"),W=(0,a.__)("Unsubscribed","newsletter-optin-box"),U=(0,a.__)("You have been unsubscribed from this mailing list and won't receive any emails from us.","newsletter-optin-box"),q=[{title:(0,a.__)("Newsletter subscriptions","newsletter-optin-box"),description:(0,a.__)("Let's get you started with Noptin. Configure your subscription preferences","newsletter-optin-box"),settings:[{settingKey:"success_message",label:(0,a.__)("Default Success Message","newsletter-optin-box"),el:"textarea",help:(0,a.__)("This is the message shown to people after they successfully sign up for your newsletter.","newsletter-optin-box"),placeholder:(0,a.__)("Thanks for subscribing to our newsletter","newsletter-optin-box")},{settingKey:"double_optin",label:(0,a.__)("Enable Double Opt-in","newsletter-optin-box"),el:"input",type:"toggle",help:(0,a.__)("Require users to confirm their email address before they are added to your list","newsletter-optin-box")},{settingKey:"pages_confirm_page_message",label:(0,a.__)("Confirmation Page Message","newsletter-optin-box"),el:"textarea",help:(0,a.__)("This is the message shown to people after they confirm their email address.","newsletter-optin-box"),placeholder:"<h1>".concat(V,"</h1>\n\n<p>").concat(Y,"</p>"),if:"double_optin"},{settingKey:"pages_unsubscribe_page_message",label:(0,a.__)("Unsubscribe Page Message","newsletter-optin-box"),el:"textarea",help:(0,a.__)("This is the message shown to people after they unsubscribe from your newsletter.","newsletter-optin-box"),placeholder:"<h1>".concat(W,"</h1>\n\n<p>").concat(U,"</p>")}],handler:z},{title:(0,a.__)("Email Sending","newsletter-optin-box"),description:(0,a.__)("Who's the sender of the emails you'll be sending?","newsletter-optin-box"),settings:[{settingKey:"from_name",label:(0,a.__)('"From" Name',"newsletter-optin-box"),el:"input",type:"text",help:(0,a.__)("How the sender name appears in outgoing emails","newsletter-optin-box")},{settingKey:"from_email",label:(0,a.__)('"From" Email',"newsletter-optin-box"),el:"input",type:"email",help:(0,a.__)("How the sender email appears in outgoing emails","newsletter-optin-box")},{settingKey:"reply_to",label:(0,a.__)('"Reply-to" Email',"newsletter-optin-box"),el:"input",type:"email",help:(0,a.__)("Where replies to your emails should be sent","newsletter-optin-box")}],handler:z},{title:(0,a.__)("Newsletter","newsletter-optin-box"),description:(0,a.__)("Subscribe to our newsletter to get the latest news and updates.","newsletter-optin-box"),settings:[{settingKey:"noptin_signup_name",label:(0,a.__)("Your Name","newsletter-optin-box"),el:"input",type:"text"},{settingKey:"noptin_signup_email",label:(0,a.__)("Your Email Address","newsletter-optin-box"),el:"input",type:"email"}],handler:function(e,t){e.noptin_signup_email.length>0&&window.fetch("https://noptin.com/wp-json/noptin/v1/subscribers",{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({email:e.noptin_signup_email,name:e.noptin_signup_name,source:"settings-wizard"})}).catch((function(e){console.error(e)})),t(e)}}];function J(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function $(e){var t=e.saved,n=r((0,o.useState)(0),2),i=n[0],s=n[1],c=i===q.length-1,u=0===i,p=q[i]?q[i]:null;return(0,o.createElement)(l.Card,{className:"noptin-settings-wizard noptin-component__section",style:{maxWidth:"520px"}},p&&(0,o.createElement)(R,function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?J(Object(n),!0).forEach((function(t){m(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):J(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({onClickNext:function(){return s(i+1)},onClickBack:function(){return s(i-1)},isLastStep:c,isFirstStep:u,saved:t},p)),!p&&(0,o.createElement)(l.CardBody,null,(0,o.createElement)("h2",null,(0,a.__)("That's all!","newsletter-optin-box")),(0,o.createElement)("p",null,(0,a.__)("You have successfully completed the settings wizard. You can now go to the settings page to customize your opt-in box.","newsletter-optin-box")),(0,o.createElement)(l.Button,{variant:"primary",href:"https://noptin.com/guide/",target:"_blank"},(0,a.__)("Read Documentation","newsletter-optin-box"))))}var G=function(){var e=r((0,o.useState)({}),2),t=e[0],n=e[1],i=r((0,o.useState)(!0),2),s=i[0],c=i[1],p=r((0,o.useState)(!1),2),m=p[0],b=p[1];return(0,o.useEffect)((function(){u()({path:"/noptin/v1/settings"}).then((function(e){n(e)})).catch((function(e){b(e.message?e.message:(0,a.__)("An unknown error occurred.","noptin"))})).finally((function(){c(!1)}))}),[]),s?(0,o.createElement)(l.Spinner,null):m?(0,o.createElement)(l.Notice,{status:"error",isDismissible:!1},m):(0,o.createElement)(o.StrictMode,null,(0,o.createElement)($,{saved:t}))};s()((function(){var e=document.getElementById("noptin-welcome-wizard");e&&(o.createRoot?(0,o.createRoot)(e).render((0,o.createElement)(G,null)):(0,o.render)((0,o.createElement)(G,null),e))}))})();