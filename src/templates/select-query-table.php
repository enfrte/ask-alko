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
		{% for column, value in row %}
			{% if column == 'product_number' %}
			<td><a href="https://www.alko.fi/tuotteet/{{ value }}" target="_blank">{{ value }}</a></td>
			{% else %}
			<td>{{ value }}</td>
			{% endif %}
		{% endfor %}
		</tr>
	{% endfor %}
	</tbody>
</table>
{% endif %}
