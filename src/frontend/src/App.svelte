<script>
  import ColumnNames from "./components/ColumnNames.svelte";
  import DbInfo from "./components/DbInfo.svelte";
  import QueryForm from "./components/QueryForm.svelte";
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
  <p>
    Hover over the column names with the info icons to see their current values.
  </p>
  <p>Results must be ajax for performance reasons.</p>
  <ColumnNames />
  <QueryForm />
</main>
