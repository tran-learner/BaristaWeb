const express = require('express');
const PayOS = require('@payos/node');

const payos = new PayOS('client_id','api-key','checksum-key');
const app = express();
app.use(express.static('public'));
app.use(express.json());

const YOUR_DOMAIN = 'http://127.0.0.1:8000/pay';
app.post('/create-payment-link',async(req,res)=>{
    const order = {
        amount: 10000,
        description: 'Thanh toan mi tom',
        orderCode: 10,
        returnUrl: `http://127.0.0.1:8000/drinks`
        cancelUrl: ``
    };
    const paymentLink = await payos.createPaymentLink(order);
    res.redirect(303,paymentLink.checkoutUrl);
})