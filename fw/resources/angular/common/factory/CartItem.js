setpoint.factory('CartItem', ['Color', 'Product', 'Size',
    function(Color, Product, Size) {
        var CartItem = function (info, selectedQuantity) {
            this._quantity = selectedQuantity;
            this.stock_id = info.id;
            this.price = parseFloat(info.price, 10);
            this.cart = info.cart;
            if(info.color_id) {
                this.color_id = info.color_id;
                this.color = Color.build(info.color);
            }
            if(info.product) {
                this.product = Product.build(info.product);
                this.product_id = info.product_id;
                this.product_discount = this.product.discount_percentage;
            }
            if(info.size) {
                this.size_id = info.size_id;
                this.size = info.size
            }
        };
        CartItem.prototype = {
            quantity : function (q) {
                if(q!==undefined) {
                    console.log(q);
                    this._quantity = q;
                    return this;
                }
                return this._quantity;
            }, 
            getSubTotal : function() {
                return this.quantity() * this.getPrice();
            },
            getStockId : function () {
                return this.stock_id;
            }, 
            getPrice : function () { 
                var price = this.getRawPrice();
                var finalPrice = this.hasDiscount() ?  price * ( 1 - (this.getDiscount()/100) ) : price;
                return finalPrice;
            },
            getRawPrice : function () {  
                return this.price;
            },
            getDiscount : function (){
                return this.product_discount;
            },
            hasDiscount : function () { 
                return !!this.product_discount ;
            },
            getCart : function () {
                return this.cart;
            }
        };
        return CartItem;
    }
]);