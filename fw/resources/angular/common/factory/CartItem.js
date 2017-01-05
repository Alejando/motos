setpoint.factory('CartItem', ['Color', 'Product', 'Size',
    function(Color, Product, Size) {
        var CartItem = function (info, selectedQuantity) {
            this._quantity = selectedQuantity;
            this.stock_id = info.id;
            this.price = parseFloat(info.price, 10);
            if(info.color_id) {
                this.color_id = info.color_id;
                this.color = Color.build(info.color);
            }
            if(info.product) {
                this.product = Product.build(info.product);
                this.product_id = info.product_id;
            }
            if(info.size) {
                this.size_id = info.size_id;
                this.size = info.size
            }
            //console.log(this);
        };
        CartItem.prototype = {
            quantity : function (q) {
                if(q) {
                    this._quantity = q;
                    return this;
                }
                return this._quantity;
            },
            getSubTotal : function() {
                return this.quantity() * this.price;
            },
            getStockId : function () {
                return this.stock_id;
            }
        };
        return CartItem;
    }
]);