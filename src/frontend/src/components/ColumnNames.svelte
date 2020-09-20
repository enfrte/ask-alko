<script>
  import { onMount } from "svelte";

  const columnNamesLink = "https://localhost/ask-alko/src/api/column-names.php";
  const selectColumnLink =
    "https://localhost/ask-alko/src/api/db-select-column.php";
  let columnNames = {};
  let selectColumn = {};

  onMount(async function () {
    const columnNamesFetch = await fetch(columnNamesLink);
    columnNames = await columnNamesFetch.json();
    //console.log(columnNames);
  });

  async function productColumnClickHandler() {
    const selectColumnFetch = await fetch(
      selectColumnLink + "?column=" + this.dataset.productColumn
    );
    selectColumn = await selectColumnFetch.json();
    console.log(selectColumn);
  }
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
    cursor: pointer;
  }
</style>

<div class="product-columns-container">
  {#if columnNames.product_columns}
    {#each columnNames.product_columns as column}
      <div
        id={column}
        class="product-columns"
        data-product-column={column}
        on:click={productColumnClickHandler}>
        {column}
      </div>
    {/each}
  {:else}
    <h3>...Loading</h3>
  {/if}
</div>
