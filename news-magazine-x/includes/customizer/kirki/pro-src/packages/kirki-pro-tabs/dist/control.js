!function(){var i;i=jQuery,wp.customize.bind("ready",(function(){!function(){var t=document.querySelectorAll("[data-kirki-parent-tab-id]");if(t.length){var a=[];[].slice.call(t).forEach((function(i){var t=i.dataset.kirkiParentTabId;a.includes(t)||a.push(t)}));var e=function(t,a){i('[data-kirki-tab-id="'+t+'"] .kirki-tab-menu-item').removeClass("is-active");var e=document.querySelector('[data-kirki-tab-id="'+t+'"] [data-kirki-tab-menu-id="'+a+'"]');e&&e.classList.add("is-active");var n=document.querySelectorAll('[data-kirki-parent-tab-id="'+t+'"]');[].slice.call(n).forEach((function(i){i.dataset.kirkiParentTabItem===a?i.classList.remove("kirki-tab-item-hidden"):i.classList.add("kirki-tab-item-hidden")}))};i(document).on("click",".kirki-tab-menu-item a",(function(i){i.preventDefault();var t=this.parentNode.parentNode.parentNode.dataset.kirkiTabId,a=this.parentNode.dataset.kirkiTabMenuId;e(t,a)})),a.forEach((function(i){wp.customize.section(i,(function(t){t.expanded.bind((function(t){if(t){var a=document.querySelector('[data-kirki-tab-id="'+i+'"] .kirki-tab-menu-item.is-active');a&&e(i,a.dataset.kirkiTabMenuId)}}))}))}))}}()}))}();
//# sourceMappingURL=control.js.map
