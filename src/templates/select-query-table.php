{% if sqlQuery|length == 0 %}
	<div class="alert alert-warning" role="alert">
		No results found.
	</div>
{% else %}
<table class="table">
	<thead>
		<tr>
		{% for column in columns %}
			<th scope="col">{{ column }}</th>
		{% endfor %}
		</tr>
	</thead>
	<tbody>
	{% for row in sqlQuery %}
		<tr>
		{% for value in row %}
			<td>{{ value }}</td>
		{% endfor %}
		</tr>
	{% endfor %}
	</tbody>
</table>
{% endif %}
