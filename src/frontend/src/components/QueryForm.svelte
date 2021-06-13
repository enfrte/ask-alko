<script>
  //const text = document.querySelector("textarea").value;
  //const lines = text.split(/\r|\r\n|\n/);
  //const count = lines.length;
  //console.log(count);
  import { columnQuery } from "../stores.js";

  let sqlQuery = "";

  columnQuery.subscribe((value) => {
    return (sqlQuery = value);
  });
</script>

<style>
  textarea {
    width: 100%;
  }
</style>

<form>
  <textarea style="height:40px;" name="" id="" bind:value={sqlQuery} />
  <button>Submit</button>
</form>
