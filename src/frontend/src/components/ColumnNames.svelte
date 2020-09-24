<script>
  import { onMount } from "svelte";
  import { selectColumn } from "../stores.js";

  const selectColumnLink =
    "https://localhost/ask-alko/src/api/db-select-column.php";
  let columnNames = {};

  // get db table column names
  onMount(async function () {
    const columnNamesFetch = await fetch(
      "https://localhost/ask-alko/src/api/column-names.php"
    );
    columnNames = await columnNamesFetch.json();
  });

  // fetch column data from db
  async function productColumnClickHandler() {
    const selectColumnFetch = await fetch(
      selectColumnLink + "?column=" + this.dataset.productColumn
    );
    const selectColumnJson = await selectColumnFetch.json();
    selectColumn.set(selectColumnJson);
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
