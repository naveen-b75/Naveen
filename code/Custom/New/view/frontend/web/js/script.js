define([
        'underscore',
        'jquery',
        'jquery/ui',
    ],function (_,$) {
        'use strict';
        $.widget('mage.UdemyTitles',{
            newLabelHTML:'<span class="custom-new">New</span>',
            _create:function () {
                this.elementTitle=$(this.element[0]);
                var title=this.elementTitle.text();
                this.elementTitle.text(title+' '+this.options.suffix);
                this.elementTitle.append($(this.newLabelHTML));
            }
        });
        return $.mage.UdemyTitles;
    }
);