<template>
    <button @click="openWompiCheckout">pagar</button>
    <form ref="btnPayment">
    </form>
</template>
<script>

</script>
<script lang="ts" setup>
    import {onMounted,ref,Ref,onBeforeMount} from 'vue';
    let btnPayment:Ref=ref(null);
    onBeforeMount(() => {
        let script = document.createElement('script');
        script.setAttribute("src","https://checkout.wompi.co/widget.js");
        script.setAttribute("type","text/javascript");
        /*script.setAttribute("data-public-key","pub_test_a0o6QsjxremuUDqHpdVKzNbjqns4EL7p");
        script.setAttribute("data-currency","COP");
        script.setAttribute("data-amount-in-cents","7890000");
        script.setAttribute("data-reference","4XMPGKWWPKWQ");
        script.setAttribute("data-signature:",'integrity="test_integrity_MMP9tGxP6fm0LlwG4DKrflQjBedHBRZW"');
        script.setAttribute("data-render","button");
        btnPayment.value.appendChild(script);
        */
       document.head.appendChild(script);
    }),
    onMounted(function() {

       function openWompiCheckout(){
            let checkout = new WidgetCheckout({
                    currency: 'COP',
                    amountInCents: 2490000,
                    reference: 'AD002901221',
                    publicKey: 'pub_fENJ3hdTJxdzs3hd35PxDBSMB4f85VrgiY3b6s1',
                    signature: { integrity: '3a4bd1f3e3edb5e88284c8e1e9a191fdf091ef0dfca9f057cb8f408667f054d0' },
                    redirectUrl: 'https://transaction-redirect.wompi.co/check',
                    expirationTime: '2023-06-09T20:28:50.000Z',
                    taxInCents: {
                    vat: 1900,
                    consumption: 800,
                    },
                    customerData: {
                    email: 'lola@gmail.com',
                    fullName: 'Lola Flores',
                    phoneNumber: '3040777777',
                    phoneNumberPrefix: '+57',
                    legalId: '123456789',
                    legalIdType: 'CC',
                    },
                    shippingAddress: {
                    addressLine1: 'Calle 123 # 4-5',
                    city: 'Bogota',
                    phoneNumber: '3019444444',
                    region: 'Cundinamarca',
                    country: 'CO',
                    }
            });
            checkout.open(function ( result ) {
                var transaction = result.transaction
                console.log('Transaction ID: ', transaction.id)
                console.log('Transaction object: ', transaction)
            })
        }
    })
</script>

<style scoped>

</style>
