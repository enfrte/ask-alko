<script>
  import { onMount } from "svelte";

  const columnNamesLink = "https://localhost/ask-alko/src/api/column-names.php";
  let columnNames = {};

  onMount(async function () {
    const columnNamesFetch = await fetch(columnNamesLink);
    columnNames = await columnNamesFetch.json();
    //console.log(columnNames);
  });
</script>

<style>
  .product-columns-container {
    display: flex;
    flex-wrap: wrap;
  }
  .product-columns {
    background-color: pink;
    padding: 5px;
    margin: 5px;
  }
</style>

<div class="product-columns-container">
  {#if columnNames.product_columns}
    {#each columnNames.product_columns as column}
      <div id={column} class="product-columns">{column}</div>
    {/each}
  {:else}
    <h3>...Loading</h3>
  {/if}
</div>
