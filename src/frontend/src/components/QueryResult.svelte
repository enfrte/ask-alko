<script>
  import { selectColumn } from "../stores.js";

  let columnData = {};

  selectColumn.subscribe((value) => {
    columnData = value;
  });
</script>

<style>
  .result-container {
    background-color: darkslategrey;
    color: whitesmoke;
    padding: 20px;
  }
</style>

<div class="result-container">
  {#if columnData}
    {#each columnData.columnData as column}
      <div>{column}</div>
    {/each}
  {:else}Waiting...{/if}
</div>
