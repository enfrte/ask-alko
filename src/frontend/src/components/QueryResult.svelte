<script>
  import { selectColumn } from "../stores.js";

  let columnData = {};

  selectColumn.subscribe((value) => {
    return (columnData = value);
  });
</script>

<style>
  .result-container {
    background-color: #222;
    color: whitesmoke;
    padding: 20px;
  }
</style>

<div class="result-container">
  {#if columnData}
    {#each columnData.columnData as column}
      <p>{column}</p>
    {/each}
  {:else}
    <h4>First select a column or make a query</h4>
  {/if}
</div>
