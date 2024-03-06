<template>
    <Layout :tenant="tenant">
        <div class="xl:mt-24 xl:p-10 md:mt-48 mx-auto container">
            <div v-show="active" class="w-full h-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h2 class="lg:text-xl md:text-3xl font-bold mb-10 text-center">Pagos en línea</h2>
                <p class="lg:text-sm md:text-3xl text-center">
                    Consulta y paga en línea.
                    La transacción será completamente segura a través de la plataforma de pagos PSE.
                </p>
                <div class="mt-5 grid lg:grid-cols-2 lg:gap-4 md:grid-cols-1">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="consulta" class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Tipo de consulta</label>
                        <select id="consulta" class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="1">Número de factura</option>
                            <option value="2">Código de suscriptor</option>
                        </select>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label  class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Número a consultar</label>
                        <input type="text" placeholder="Ingrese número de factura o código de suscriptor"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    </div>
                </div>
                <div class="mt-10 flex justify-center lg:space-x-4 md:space-x-10">
                    <button type="button" @click="active = !active" class="inline-flex items-center lg:px-3 lg:py-2.5 md:px-3 md:py-5 lg:text-sm md:text-4xl font-medium text-center border border-blue-600 bg-white text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Consultar
                    </button>
                    <a :href="route('public.index')" class="group inline-flex items-center space-x-2 lg:px-3 lg:py-2.5 md:px-3 md:py-5 lg:text-sm md:text-4xl font-medium text-center text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-600 hover:text-white  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Cancelar
                    </a>
                </div>
            </div>
            <div v-show="!active" class="w-full h-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h2 class="lg:text-xl md:text-3xl font-bold mb-10 text-start">Información del pago</h2>
                <div class="mt-5 grid lg:grid-cols-2 lg:gap-4 md:grid-cols-1">
                    <div class="relative z-0 w-full mb-5 group">
                        <p class="lg:text-sm md:text-3xl font-bold">Número de factura:</p>
                        <p class="lg:text-sm md:text-3xl">31114178</p>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <p class="lg:text-sm md:text-3xl font-bold">Nombre del cliente:</p>
                        <p class="lg:text-sm md:text-3xl">TORRES PEREZ MARIA DEL CARMEN</p>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <p class="lg:text-sm md:text-3xl font-bold">Fecha de vencimiento:</p>
                        <p class="lg:text-sm md:text-3xl">06/03/2024</p>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <p class="lg:text-sm md:text-3xl font-bold">Valor de pago:</p>
                        <p class="lg:text-sm md:text-3xl">$41.190</p>
                    </div>
                </div>
                <br><hr><br>
                <div>
                    <h2 class="lg:text-xl md:text-3xl font-bold mb-10 text-start">Información del pagador</h2>
                    <div class="mt-5 grid lg:grid-cols-2 lg:gap-4 md:grid-cols-1">
                        <div class="relative z-0 w-full mb-5 group">
                            <label  class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Tipo de documento</label>
                            <select  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="1">Cédula de ciudadania</option>
                                <option value="2">NIT</option>
                            </select>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <label  class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Número de documento</label>
                            <input type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <label  class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Nombres</label>
                            <input type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <label  class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Apellidos</label>
                            <input type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <label  class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Teléfono</label>
                            <input type="phone"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <label  class="block mb-2 lg:text-sm md:text-3xl font-medium text-gray-900 dark:text-white">Correo</label>
                            <input type="email"  class="bg-gray-50 border border-gray-300 text-gray-900 lg:text-sm md:text-3xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                    </div>
                </div>
                <div class="mt-10 flex justify-center lg:space-x-4 md:space-x-10">
                    <button type="button" @click="showWompi" class="inline-flex items-center lg:px-3 lg:py-2.5 md:px-3 md:py-5 lg:text-sm md:text-4xl font-medium text-center border border-blue-600 bg-white text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Pagar
                    </button>
                    <button type="button" @click="active = !active" class="group inline-flex items-center space-x-2 lg:px-3 lg:py-2.5 md:px-3 md:py-5 lg:text-sm md:text-4xl font-medium text-center text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-600 hover:text-white  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script  lang="ts" setup>
    import Layout from './Layout.vue'
    import { Ref,ref,reactive } from 'vue'
    import { loadScript } from "vue-plugin-load-script";
    defineProps({ tenant: Object });

    const active:Ref<boolean> = ref(true);
    let integrity:Ref<string>= ref("");

    async function sha256(message) {

        // encode as UTF-8
        const msgBuffer = new TextEncoder().encode(message);

        // hash the message
        const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);

        // convert ArrayBuffer to Array
        const hashArray = Array.from(new Uint8Array(hashBuffer));

        // convert bytes to hex string
        integrity.value = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    }

    function makeid(length) {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        counter += 1;
        }
        return result;
    }

    function showWompi(){
        let timeOut:any;
        loadScript("https://checkout.wompi.co/widget.js")
        .then(() => {
                let currency:string = 'COP'
                let total:number = parseInt(10000+'00');
                let reference:string = makeid(7);
                let sign:string = 'test_integrity_MMP9tGxP6fm0LlwG4DKrflQjBedHBRZW';
                let concatString:String = new String(reference+total+currency+sign);
                sha256(concatString);
                const checkout = new WidgetCheckout({
                    currency: 'COP',
                    amountInCents: 2490000,
                    reference: reference,
                    publicKey: 'pub_test_a0o6QsjxremuUDqHpdVKzNbjqns4EL7p',
                    signature: {integrity : integrity.value}
                })
                window.clearTimeout(timeOut);
                timeOut = window.setTimeout(function(){
                    checkout.open(function ( result:any ) {
                        let transaction:any = result.transaction
                        if(transaction.status == "APPROVED"){
                            window.location.href= route('public.pago_confirmado');
                        }
                    })
                },1000);
            })
        .catch(function(e){
            console.log(e);
        });

    }

    function formatNumber(value){
        let number = isNaN(value) ? 0 : value

        if (number < 0 ) {
            number = Math.abs(number)
            number = '- $' + new Intl.NumberFormat('es-co').format(number)
        } else {
            number = '$' + new Intl.NumberFormat('es-co').format(number)
        }

        return number
    }


</script>

<style scoped>

</style>
