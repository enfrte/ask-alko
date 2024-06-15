
<table class="table">
  <thead>
    <tr>
        <th scope="col">{{ column }}</th>
    </tr>
  </thead>
  <tbody>
    {% for value in data %}
      <tr>
          <td>{{ value }}</td>
      </tr>
    {% endfor %}
  </tbody>
</table>
