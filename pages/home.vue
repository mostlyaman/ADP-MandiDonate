<template>
    <Head>
        <Title>Home - DMS</Title>
    </Head>
    <Header :state="{text:'Logout', path: '/'}" />

    <div class="w-[80vw] min-w-[500px] mx-auto m-12 p-3 flex">
        <DonationList class="w-2/3" />
    </div>
</template>

<script setup>

</script>