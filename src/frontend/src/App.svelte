<script>
  import { writable } from "svelte/store";
  import { selectColumn } from "./stores.js";
  import ColumnNames from "./components/ColumnNames.svelte";
  import DbInfo from "./components/DbInfo.svelte";
  import QueryForm from "./components/QueryForm.svelte";
  import QueryResult from "./components/QueryResult.svelte";
</script>

<style>
  main {
    text-align: center;
    padding: 1em;
    max-width: none;
    margin: 0 auto;
  }
  hr {
    height: 1px;
    border: none;
    color: pink;
    background-color: pink;
  }
  @media (min-width: 640px) {
    main {
      max-width: 800px;
    }
  }
</style>

<main>
  <DbInfo />
  <hr />
  <p>Select a column names with the info icons to see their current values.</p>
  <ColumnNames />
  <p>Write queries here</p>
  <QueryForm />
  <p>Query results</p>
  <QueryResult />
</main>
