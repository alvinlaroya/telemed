<table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col"><b>Patient</b></th>
        <th scope="col"><b>No. of Transaction</b></th>
      </tr>
    </thead>
    <tbody>
      @if(count($patients) > 0)
          @foreach($patients as $patient)
          <tr>
              <td>{{ $patient->name }}</td>
              <td><a href="{{ route('admin.reports.patientTransactionDetails', $patient) }}">{{ $patient->bookings_count }}</a></td>
          </tr>
          @endforeach
      @else
          <tr><td class="text-center" colspan="5">No records found.</td></tr>
      @endif
     </tbody>
  </table>
