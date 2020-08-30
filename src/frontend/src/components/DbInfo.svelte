<script>
  import { onMount } from "svelte";

  const dbInfoLink = "https://localhost/ask-alko/src/api/db-info.php";
  let dbInfo = {};

  onMount(async function () {
    const dbInfoFetch = await fetch(dbInfoLink);
    dbInfo = await dbInfoFetch.json();
  });
</script>

<div>
  {#if dbInfo.pricelist_date}
    <h2>{dbInfo.pricelist_date}</h2>
  {:else}
    <h3>...Loading</h3>
    <p>...Loading</p>
  {/if}
</div>
